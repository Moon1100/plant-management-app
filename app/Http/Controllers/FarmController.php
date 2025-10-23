<?php

namespace App\Http\Controllers;

use App\Models\Farm;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class FarmController extends Controller
{
    public function index(): View
    {
        $farms = auth()->user()->farms()->withCount('plants')->paginate(12);

        return view('farms.index', compact('farms'));
    }

    public function create(): View
    {
        return view('farms.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $data = array_merge((array) $validated, [
            'slug' => Str::slug($validated['name']),
        ]);

        $farm = auth()->user()->farms()->create($data);

        return redirect()->route('public.farms.show', $farm->slug)
            ->with('success', 'Farm created successfully!');
    }

    public function show(Farm $farm): View
    {
        $this->authorize('view', $farm);

        $farm->load(['plants' => function($query) {
            $query->latest()->take(12);
        }]);

        return view('farms.show', compact('farm'));
    }

    public function edit(Farm $farm): View
    {
        $this->authorize('update', $farm);

        return view('farms.edit', compact('farm'));
    }

    public function update(Request $request, Farm $farm): RedirectResponse
    {
        $this->authorize('update', $farm);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $data = array_merge((array) $validated, [
            'slug' => Str::slug($validated['name']),
        ]);

        $farm->update($data);

        return redirect()->route('public.farms.show', $farm->slug)
            ->with('success', 'Farm updated successfully!');
    }

    public function destroy(Farm $farm): RedirectResponse
    {
        $this->authorize('delete', $farm);

        $farm->delete();

        return redirect()->route('farms.index')
            ->with('success', 'Farm deleted successfully!');
    }
}
