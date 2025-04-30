@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold text-orange-600 mb-6">Driver Dashboard</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Driver-specific content -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h2 class="text-lg font-semibold mb-2">Your Bus</h2>
                    <p class="text-gray-700">Manage your bus information and schedule.</p>
                </div>
                
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h2 class="text-lg font-semibold mb-2">Current Passengers</h2>
                    <p class="text-gray-700">View passengers on your current route.</p>
                </div>
                
                <div class="bg-gray