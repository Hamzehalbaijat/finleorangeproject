<?php
// app/Http/Controllers/ReportController.php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Bus;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::with(['user', 'bus'])->get();
        return view('reports.index', compact('reports'));
    }

    public function create(Bus $bus)
    {
        return view('reports.create', compact('bus'));
    }

    public function store(Request $request, Bus $bus)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        Report::create([
            'user_id' => auth()->id(),
            'bus_id' => $bus->id,
            'message' => $validated['message'],
        ]);

        return redirect()->route('buses.show', $bus)
            ->with('success', 'Report submitted successfully.');
    }

    public function show(Report $report)
    {
        return view('reports.show', compact('report'));
    }

    public function update(Request $request, Report $report)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,resolved',
        ]);

        $report->update($validated);

        return back()->with('success', 'Report status updated successfully.');
    }

    public function destroy(Report $report)
    {
        $report->delete();
        return back()->with('success', 'Report deleted successfully.');
    }
}