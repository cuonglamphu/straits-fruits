<?php

namespace App\Repositories;

use App\Interfaces\FruitRepositoryInterface;
use App\Models\Fruit;

class FruitRepository implements FruitRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function index()
    {
        return Fruit::all();
    }

    /**
     * Show a specific fruit.
     *
     * @param int $id
     * @return Fruit
     */
    public function show(int $id)
    {
        return Fruit::findOrFail($id);
    }

    /**
     * Get fruits by category.
     *
     * @param int $category_id
     * @return Fruit
     */
    public function getFruitByCategory(int $category_id)
    {
        return Fruit::where('category_id', $category_id)->get();
    }

    /**
     * Store a new fruit.
     *
     * @param array $fruitDetail
     * @return Fruit
     */
    public function store(array $fruitDetail)
    {
        return Fruit::create($fruitDetail);
    }
}
