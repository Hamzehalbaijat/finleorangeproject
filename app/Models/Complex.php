<?php
// app/Models/Complex.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Complex extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'location',
        'latitude',
        'longitude',
        'image'
    ];

    public function buses()
    {
        return $this->hasMany(Bus::class);
    }

    public function dashboard()
{
    $complexes = Complex::all();
    return view('passenger/dashboard', compact('complexes'));
}
}