<?php
// app/Http/Controllers/ComplexController.php

namespace App\Http\Controllers;

use App\Models\Complex;
use Illuminate\Http\Request;

class ComplexController extends Controller
{
    public function index()
    {
        $complexes = Complex::all();
        return view('complexes.index', compact('complexes'));
    }

    public function create()
    {
        return view('complexes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('complexes', 'public');
        }

        Complex::create($validated);

        return redirect()->route('complexes.index')->with('success', 'Complex created successfully.');
    }

    public function show(Complex $complex)
    {
        return view('complexes.show', compact('complex'));
    }

    public function edit(Complex $complex)
    {
        return view('complexes.edit', compact('complex'));
    }

    public function update(Request $request, Complex $complex)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {

            if ($complex->image) {
                Storage::disk('public')->delete($complex->image);
            }
            $validated['image'] = $request->file('image')->store('complexes', 'public');
        }

        $complex->update($validated);

        return redirect()->route('complexes.index')->with('success', 'Complex updated successfully.');
    }

    public function destroy(Complex $complex)
    {
        $complex->delete();
        return redirect()->route('complexes.index')->with('success', 'Complex deleted successfully.');
    }
}