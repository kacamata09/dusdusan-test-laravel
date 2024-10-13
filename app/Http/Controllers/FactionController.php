<?php

namespace App\Http\Controllers;

use App\Models\Faction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FactionController extends Controller
{
    public function index(): JsonResponse
    {
        $factions = Faction::all();

        return response()->json($factions, 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:factions,name',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $faction = Faction::create([
            'name' => $request->input('name'),
        ]);

        return response()->json([
            'message' => 'Faction created successfully!',
            'data' => $faction
        ], 201);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:factions,name,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $faction = Faction::findOrFail($id);
        $faction->update([
            'name' => $request->input('name'),
        ]);

        return response()->json([
            'message' => 'Faction updated successfully!',
            'data' => $faction
        ], 200);
    }

    public function destroy($id): JsonResponse
    {
        $faction = Faction::findOrFail($id);
        $faction->delete();

        return response()->json(['message' => 'Faction deleted successfully!'], 200);
    }
}
