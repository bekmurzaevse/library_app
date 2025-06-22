<?php

namespace App\Http\Controllers;

use App\Actions\Book\CreateAction;
use App\Actions\Book\DeleteAction;
use App\Actions\Book\IndexAction;
use App\Actions\Book\ShowAction;
use App\Actions\Book\UpdateAction;
use App\Dto\Book\CreateDto;
use App\Dto\Book\UpdateDto;
use App\Http\Requests\Book\CreateRequest;
use App\Http\Requests\Book\UpdateRequest;
use Illuminate\Http\JsonResponse;

class BookController extends Controller
{
    /**
     * Summary of index
     * @param \App\Actions\Book\IndexAction $action
     * @return JsonResponse
     */
    public function index(IndexAction $action): JsonResponse
    {
        return $action();
    }

    /**
     * Summary of store
     * @param \App\Http\Requests\Book\CreateRequest $request
     * @param \App\Actions\Book\CreateAction $action
     * @return JsonResponse
     */
    public function store(CreateRequest $request, CreateAction $action): JsonResponse
    {
        return $action(CreateDto::from($request));
    }

    /**
     * Summary of show
     * @param int $id
     * @param \App\Actions\Book\ShowAction $action
     * @return JsonResponse
     */
    public function show(int $id, ShowAction $action): JsonResponse
    {
        return $action($id);
    }

    /**
     * Summary of update
     * @param \App\Http\Requests\Book\UpdateRequest $request
     * @param int $id
     * @param \App\Actions\Book\UpdateAction $action
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, int $id, UpdateAction $action): JsonResponse
    {
        return $action($id, UpdateDto::from($request));
    }

    /**
     * Summary of destroy
     * @param int $id
     * @param \App\Actions\Book\DeleteAction $action
     * @return JsonResponse
     */
    public function delete(int $id, DeleteAction $action): JsonResponse
    {
        return $action($id);
    }
}
