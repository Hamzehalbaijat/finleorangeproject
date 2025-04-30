<?php
// app/Http/Controllers/PaymentController.php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Bus;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with(['user', 'bus'])->get();
        return view('passenger.payments.index', compact('payments'));
    }

    public function create(Bus $bus)
    {
        return view('payments.create', compact('bus'));
    }

    public function store(Request $request, Bus $bus)
    {
        $user = auth()->user();
        
        $validated = $request->validate([
            'payment_method' => 'required|in:nfc,balance',
        ]);

        // Check if user has enough balance if paying with balance
        if ($validated['payment_method'] === 'balance' && $user->balance < $bus->fee) {
            return back()->with('error', 'Insufficient balance');
        }

        // Create payment record
        $payment = Payment::create([
            'user_id' => $user->id,
            'bus_id' => $bus->id,
            'payment_method' => $validated['payment_method'],
            'transaction_id' => Str::uuid(),
            'amount' => $bus->fee,
            'status' => 'pending',
        ]);

        // Process payment
        if ($validated['payment_method'] === 'balance') {
            $user->decrement('balance', $bus->fee);
            $payment->update(['status' => 'completed']);
            
            // Add user to bus passengers
            $bus->passengers()->attach($user->id, [
                'pickup_location' => $request->pickup_location,
                'pickup_latitude' => $request->pickup_latitude,
                'pickup_longitude' => $request->pickup_longitude,
                'destination' => $request->destination,
                'destination_latitude' => $request->destination_latitude,
                'destination_longitude' => $request->destination_longitude,
                'status' => 'waiting',
            ]);
            
            $bus->increment('occupied_seats');
            
            return redirect()->route('buses.show', $bus)
                ->with('success', 'Payment completed successfully. You are now registered for this bus.');
        }

        // For NFC payments, we would typically redirect to a payment gateway
        return redirect()->route('payments.nfc', $payment);
    }

    public function show(Payment $payment)
    {
        return view('payments.show', compact('payment'));
    }

    public function processNfc(Payment $payment)
    {
        // This would be where you integrate with the NFC payment API
        // For now, we'll simulate a successful payment
        
        $payment->update(['status' => 'completed']);
        $payment->user->decrement('balance', $payment->amount);
        
        // Add user to bus passengers
        $payment->bus->passengers()->attach($payment->user_id, [
            'status' => 'waiting',
        ]);
        
        $payment->bus->increment('occupied_seats');
        
        return redirect()->route('payments.show', $payment)
            ->with('success', 'NFC payment completed successfully.');
    }
}