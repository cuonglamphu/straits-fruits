<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Http\Requests\StoreUnitRequest;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\UnitResource;
use App\Interfaces\UnitRepositoryInterface;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    private UnitRepositoryInterface $unitRepository;

    public function __construct(UnitRepositoryInterface $unitRepository)
    {
        $this->unitRepository = $unitRepository;
    }

    public function index()
    {
        $data = $this->unitRepository->index();
        return ApiResponseClass::sendResponse(UnitResource::collection($data), 'Units retrieved successfully.', 200);
    }

    public function show(int $id)
    {
        $data = $this->unitRepository->show($id);
        return ApiResponseClass::sendResponse(new UnitResource($data), '', 200);
    }

    public function store(StoreUnitRequest $request)
    {
        $data = $this->unitRepository->store($request->all());
        return ApiResponseClass::sendResponse(new UnitResource($data), 'Unit created successfully.', 201);
    }

    public function update(int $id, array $data)
    {
        $data = $this->unitRepository->update($data, $id);
        return ApiResponseClass::sendResponse(new UnitResource($data), 'Unit updated successfully.', 200);
    }
}
