<?php

namespace App\Http\Controllers;

use App\Actions\Booking\CreateAction;
use App\Actions\Booking\DeleteAction;
use App\Actions\Booking\IndexAction;
use App\Actions\Booking\ShowAction;
use App\Actions\Booking\UpdateAction;
use App\Dto\Booking\CreateDto;
use App\Dto\Booking\UpdateDto;
use App\Http\Requests\Booking\CreateRequest;
use App\Http\Requests\Booking\UpdateRequest;
use Illuminate\Http\JsonResponse;

class BookingController extends Controller
{

    /**
     * Summary of index
     * @param \App\Actions\Booking\IndexAction $action
     * @return JsonResponse
     */
    public function index(IndexAction $action): JsonResponse
    {
        return $action();
    }

    /**
     * Summary of show
     * @param \App\Actions\Booking\ShowAction $action
     * @param int $id
     * @return JsonResponse
     */
    public function show(ShowAction $action, int $id): JsonResponse
    {
        return $action($id);
    }

    /**
     * Summary of create
     * @param \App\Http\Requests\Booking\CreateRequest $request
     * @param \App\Actions\Booking\CreateAction $action
     * @return JsonResponse
     */
    public function create(CreateRequest $request, CreateAction $action): JsonResponse
    {
        return $action(CreateDto::from($request));
    }

    /**
     * Summary of update
     * @param int $id
     * @param \App\Http\Requests\Booking\UpdateRequest $request
     * @param \App\Actions\Booking\UpdateAction $action
     * @return JsonResponse
     */
    public function update(int $id, UpdateRequest $request, UpdateAction $action): JsonResponse
    {
        return $action($id, UpdateDto::from($request));
    }

    /**
     * Summary of delete
     * @param int $id
     * @param \App\Actions\Booking\DeleteAction $action
     * @return JsonResponse
     */
    public function delete(int $id, DeleteAction $action): JsonResponse
    {
        return $action($id);
    }
}
