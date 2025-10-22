<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Farm;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class FarmController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Farm::with('user')->withCount('plants');

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->has('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        $farms = $query->paginate($request->get('per_page', 15));

        return response()->json($farms);
    }

    public function show(string $slug): JsonResponse
    {
        $farm = Farm::where('slug', $slug)
            ->with(['user', 'plants' => function($query) {
                $query->latest()->take(20);
            }])
            ->firstOrFail();

        return response()->json($farm);
    }

    public function plants(string $slug, Request $request): JsonResponse
    {
        $farm = Farm::where('slug', $slug)->firstOrFail();

        $query = $farm->plants();

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $plants = $query->paginate($request->get('per_page', 20));

        return response()->json($plants);
    }
}
