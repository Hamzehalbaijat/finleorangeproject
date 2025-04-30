<?php
// app/Http/Controllers/ReviewController.php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Bus;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Bus $bus)
    {
        $reviews = $bus->reviews()->with('user')->get();
        return view('passenger.reviews.index', compact('bus', 'reviews'));
    }

    public function create(Bus $bus)
    {
        // Check if user has ridden this bus before allowing review
        if (!auth()->user()->rides()->where('bus_id', $bus->id)->exists()) {
            return redirect()->route('passenger.buses.show', $bus)
                ->with('error', 'You can only review buses you have ridden.');
        }
        
        // Check if user has already reviewed this bus
        if (Review::where('user_id', auth()->id())->where('bus_id', $bus->id)->exists()) {
            return redirect()->route('passenger.buses.show', $bus)
                ->with('error', 'You have already reviewed this bus.');
        }
        
        return view('passenger.reviews.create', compact('bus'));
    }

    public function store(Request $request, Bus $bus)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|between:1,5',
            'comment' => 'nullable|string|max:1000',
        ]);

        Review::create([
            'user_id' => auth()->id(),
            'bus_id' => $bus->id,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        return redirect()->route('passenger.buses.show', $bus)
            ->with('success', 'Review submitted successfully.');
    }

    public function destroy(Review $review)
    {
        $this->authorize('delete', $review);
        
        $review->delete();
        return back()->with('success', 'Review deleted successfully.');
    }
}