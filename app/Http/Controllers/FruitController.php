<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Http\Resources\FruitResource;
use App\Interfaces\FruitRepositoryInterface;
use App\Http\Requests\StoreFruitsRequest;
use Illuminate\Support\Facades\DB;

class FruitController extends Controller
{
    private FruitRepositoryInterface $fruitRepository;
    public function __construct(FruitRepositoryInterface $fruitRepository)
    {
        $this->fruitRepository = $fruitRepository;
    }

    public function index()
    {
        $data = $this->fruitRepository->index();
        return ApiResponseClass::sendResponse(FruitResource::collection($data), 'Fruits retrieved successfully', 200);
    }

    public function show(int $id)
    {
        $data = $this->fruitRepository->show($id);
        return ApiResponseClass::sendResponse(new FruitResource($data), '', 200);
    }

    public function store(StoreFruitsRequest $request)
    {
        $detail = [
            'Fruit_Name' => $request->Fruit_Name,
            'Price' => $request->Price,
            'Category_ID' => $request->Category_ID,
            'Unit_ID' => $request->Unit_ID,
        ];
        DB::beginTransaction();
        try {
            $data = $this->fruitRepository->store($detail);
            DB::commit();
            return ApiResponseClass::sendResponse(new FruitResource($data), 'Fruit created successfully', 201);
        } catch (\Exception $e) {
            $errorMessage = $request->input('message', 'Failed to create fruit due to a server error.');
            ApiResponseClass::rollback($e, $errorMessage);
        }
    }

    public function getFruitByCategory(int $id)
    {
        $data = $this->fruitRepository->getFruitByCategory($id);
        return ApiResponseClass::sendResponse(FruitResource::collection($data), '', 200);
    }
}
