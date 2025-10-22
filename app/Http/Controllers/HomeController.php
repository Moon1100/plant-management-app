<?php

namespace App\Http\Controllers;

use App\Models\Farm;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $publicFarms = Farm::where('is_public', true)
            ->with(['plants' => function($query) {
                $query->latest()->limit(3);
            }])
            ->latest()
            ->limit(6)
            ->get();

        return view('welcome', compact('publicFarms'));
    }
}
