<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\StoreCategoryRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\CategoryResource;
use App\Interfaces\CategoryRepositoryInterface;
use App\Classes\ApiResponseClass;
use Inertia\Response;

class CategoryController extends Controller
{
    private CategoryRepositoryInterface $categoryRepository;


    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    //index
    public function index()
    {
        $data = $this->categoryRepository->index();
        return ApiResponseClass::sendResponse(CategoryResource::collection($data),'', 200);
    }

    //get category by id
    public function show(int $id)
    {
        $data = $this->categoryRepository->show($id);
        return ApiResponseClass::sendResponse(new CategoryResource($data),'', 200);
    }

    //create a Category
    public function store(StoreCategoryRequest $request)
    {
        $detail = [
            'Category_Name' => $request->Category_Name,
        ];
        DB::beginTransaction();
        try {
            $data = $this->categoryRepository->store($detail);
            DB::commit();
            return ApiResponseClass::sendResponse(new CategoryResource($data),'Category created successfully', 201);
        } catch (\Exception $e) {
            $errorMessage = $request->input('message', 'Failed to create category due to a server error.');
            ApiResponseClass::rollback($e, $errorMessage);
        }
    }
}
