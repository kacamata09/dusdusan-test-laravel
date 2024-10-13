<?php

namespace App\Http\Controllers;

use App\Models\Robot;
use App\Models\Faction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class RobotController extends Controller
{
    public function index(): JsonResponse
    {
        $robots = Robot::with('faction')->get();
        $transformedRobots = $robots->map(function ($robot) {
            return [
                'id' => $robot->id,
                'robot_name' => $robot->name,
                'faction_name' => $robot->faction->name,
            ];
        });

        return response()->json($transformedRobots, 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'faction_id' => 'required|exists:factions,id',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $robot = Robot::create($request->only('name', 'faction_id'));
        return response()->json([
            'message' => 'data robot baru berhasil dibuat!',
            'data' => [
                'id' => $robot->id,
                'robot_name' => $robot->name,
                'faction_name' => $robot->faction->name,
            ]
        ], 201);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'faction_id' => 'sometimes|required|exists:factions,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $robot = Robot::findOrFail($id);
        $robot->update($request->only('name', 'faction_id'));

        return response()->json([
            'message' => 'Robot updated successfully!',
            'data' => [
                'id' => $robot->id,
                'robot_name' => $robot->name,
                'faction_name' => $robot->faction->name,
            ]
        ], 200);
    }

    public function destroy($id): JsonResponse
    {
        $robot = Robot::findOrFail($id);
        $robot->delete();

        return response()->json(['message' => 'Robot deleted successfully!'], 200);
    }
}

