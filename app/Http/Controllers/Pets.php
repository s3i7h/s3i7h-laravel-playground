<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class Pets extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        /**
         * @var string|null $limit
         */
        $limit = $request->get('limit');
        $pets = Pet::query()->limit((int)$limit)->get();

        return new JsonResponse($pets);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): Response
    {
        /**
         * @var array<string, mixed> $input
         */
        $input = $request->all();
        $pet = Pet::factory()->create($input);
        $pet->save();
        return new Response(status: 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $pet = Pet::query()->find($id) ?: \abort(404);
        return new JsonResponse($pet);
    }
}
