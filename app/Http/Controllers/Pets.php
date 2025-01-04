<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Request;

class Pets extends Controller
{
    public function __construct(
        readonly private Request  $request,
        readonly private Response $response
    )
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $limit = $this->request::get('limit');

        return $this->response::json([
            ['id' => 1, 'name' => 'Pochi'],
            ['id' => 2, 'name' => 'Tama', 'tag' => 'popular'],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        return $this->response::json(['id' => 1, 'name' => 'Pochi', 'tag' => 'dog']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }
}
