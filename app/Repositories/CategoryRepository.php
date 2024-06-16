<?php

namespace App\Repositories;

use  App\Models\Category;
use App\Interfaces\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function index()
    {
        return Category::all();
    }

    /**
     * Show a specific category.
     *
     * @param int $id
     * @return Category
     */
    public function show(int $id)
    {
        return Category::findOrFail($id);
    }

    /**
     * Store a new category.
     *
     * @param array $categoryDetail
     * @return Category
     */
    public function store(array $categoryDetail)
    {
        return Category::create($categoryDetail);
    }
}
