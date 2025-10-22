<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use App\Models\Farm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PlantController extends Controller
{
    public function index(): View
    {
        $plants = Plant::whereHas('farm', function($query) {
            $query->where('user_id', auth()->id());
        })->with('farm')->paginate(16);

        return view('plants.index', compact('plants'));
    }

    public function create(Request $request): View
    {

    
        $farms = auth()->user()->farms;
        $selectedFarm = $request->get('farm') ? Farm::find($request->get('farm')) : null;

        return view('plants.create', compact('farms', 'selectedFarm'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'batch' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'planted_at' => 'nullable|date',
            'insertion_date' => 'nullable|date',
            'farm_id' => 'required|exists:farms,id',
            'images.*' => 'nullable|image|max:2048',
        ]);

        $farm = Farm::findOrFail($validated['farm_id']);
        $this->authorize('createPlant', $farm);

        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $images[] = $image->store('plants', 'public');
            }
        }

        $plant = Plant::create([
            ...$validated,
            'images' => $images,
        ]);

        return redirect()->route('public.plants.show', $plant->plant_code)
            ->with('success', 'Plant created successfully!');
    }

    public function show(Plant $plant): View
    {
        $this->authorize('view', $plant);

        $plant->load(['farm', 'updates.user']);

        return view('plants.show', compact('plant'));
    }

    public function edit(Plant $plant): View
    {
        $this->authorize('update', $plant);

        $farms = auth()->user()->farms;

        return view('plants.edit', compact('plant', 'farms'));
    }

    public function update(Request $request, Plant $plant): RedirectResponse
    {
        $this->authorize('update', $plant);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'batch' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'planted_at' => 'nullable|date',
            'insertion_date' => 'nullable|date',
            'farm_id' => 'required|exists:farms,id',
            'images.*' => 'nullable|image|max:2048',
            'remove_images' => 'nullable|array',
        ]);

        $farm = Farm::findOrFail($validated['farm_id']);
        $this->authorize('createPlant', $farm);

        $images = $plant->images ?? [];

        // Remove selected images
        if ($request->has('remove_images')) {
            foreach ($request->remove_images as $imageToRemove) {
                Storage::disk('public')->delete($imageToRemove);
                $images = array_filter($images, fn($img) => $img !== $imageToRemove);
            }
        }

        // Add new images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $images[] = $image->store('plants', 'public');
            }
        }

        $plant->update([
            ...$validated,
            'images' => array_values($images),
        ]);

        return redirect()->route('public.plants.show', $plant->plant_code)
            ->with('success', 'Plant updated successfully!');
    }

    public function destroy(Plant $plant): RedirectResponse
    {
        $this->authorize('delete', $plant);

        // Delete images
        if ($plant->images) {
            foreach ($plant->images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $farm = $plant->farm;
        $plant->delete();

        return redirect()->route('public.farms.show', $farm->slug)
            ->with('success', 'Plant deleted successfully!');
    }
}
