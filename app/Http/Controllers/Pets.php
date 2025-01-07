<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Request;

class Pets extends Controller
{
    public function __construct(
        readonly private App      $app,
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
        if (!\is_null($limit)) $limit = (int)$limit;

        $pets = Pet::query()->limit($limit)->get();

        return $this->response::json($pets);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): HttpResponse
    {
        $pet = Pet::factory()->create($request::all());
        $pet->save();
        return $this->response::noContent(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $pet = Pet::query()->find($id);
        if (\is_null($pet)) $this->app::abort(404);
        return $this->response::json($pet);
    }
}
