<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Plant;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PlantController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Plant::with('farm');

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->has('farm_id')) {
            $query->where('farm_id', $request->farm_id);
        }

        $plants = $query->paginate($request->get('per_page', 20));

        return response()->json($plants);
    }

    public function show(string $plantCode): JsonResponse
    {
        $plant = Plant::where('plant_code', $plantCode)
            ->with(['farm.user', 'updates.user'])
            ->firstOrFail();

        return response()->json($plant);
    }

    public function updates(string $plantCode, Request $request): JsonResponse
    {
        $plant = Plant::where('plant_code', $plantCode)->firstOrFail();

        $updates = $plant->updates()
            ->with('user')
            ->paginate($request->get('per_page', 10));

        return response()->json($updates);
    }
}
