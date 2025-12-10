<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttachAbilityRequest;
use App\Http\Requests\StoreCreatureRequest;
use App\Http\Requests\UpdateCreatureRequest;
use App\Models\Creature;
use Illuminate\Http\JsonResponse;

class CreatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $creatures = Creature::with(['abilities', 'galleryImages'])->get();

        return response()->json([
            'message' => 'Creatures retrieved successfully',
            'data' => $creatures,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCreatureRequest $request): JsonResponse
    {
        $creature = Creature::create($request->validated());

        return response()->json([
            'message' => 'Creature created successfully',
            'data' => $creature,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Creature $creature): JsonResponse
    {
        $creature->load(['abilities', 'galleryImages']);

        return response()->json([
            'message' => 'Creature retrieved successfully',
            'data' => $creature,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCreatureRequest $request, Creature $creature): JsonResponse
    {
        $creature->update($request->validated());

        return response()->json([
            'message' => 'Creature updated successfully',
            'data' => $creature,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Creature $creature): JsonResponse
    {
        $creature->delete();

        return response()->json([
            'message' => 'Creature deleted successfully',
        ]);
    }

    /**
     * Attach an ability to a creature
     */
    public function attachAbility(AttachAbilityRequest $request, Creature $creature): JsonResponse
    {
        $abilityId = $request->validated()['ability_id'];

        if ($creature->abilities()->where('ability_id', $abilityId)->exists()) {
            return response()->json([
                'message' => 'Ability already attached to this creature',
            ], 422);
        }

        $creature->abilities()->attach($abilityId);

        return response()->json([
            'message' => 'Ability attached successfully',
            'data' => $creature->load('abilities'),
        ]);
    }

    /**
     * Detach an ability from a creature
     */
    public function detachAbility(Creature $creature, int $abilityId): JsonResponse
    {
        if (!$creature->abilities()->where('ability_id', $abilityId)->exists()) {
            return response()->json([
                'message' => 'Ability not found on this creature',
            ], 404);
        }

        $creature->abilities()->detach($abilityId);

        return response()->json([
            'message' => 'Ability detached successfully',
        ]);
    }
}
