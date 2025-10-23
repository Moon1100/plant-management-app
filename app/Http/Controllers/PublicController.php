<?php

namespace App\Http\Controllers;

use App\Models\Farm;
use App\Models\Plant;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicController extends Controller
{
    public function home(): View
    {
        $recentFarms = Farm::with('user')
            ->withCount('plants')
            ->latest()
            ->take(6)
            ->get();

        $recentPlants = Plant::with('farm')
            ->latest()
            ->take(8)
            ->get();

        return view('public.home', compact('recentFarms', 'recentPlants'));
    }

    public function farms(): View
    {  $farms = Farm::where('is_public', true)->paginate(12);

        return view('public.farm-index',compact('farms'));
    }

    public function showFarm(string $slug): View
    {
        $farm = Farm::where('slug', $slug)
            ->with('user')
            ->firstOrFail();

        return view('public.farm-show', compact('farm'));
    }

    public function showPlant(string $plantCode): View
    {
        $plant = Plant::where('plant_code', $plantCode)
            ->with(['farm.user', 'updates.user'])
            ->firstOrFail();

        return view('public.plant-show', compact('plant'));
    }
}
