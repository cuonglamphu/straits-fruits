<?php

namespace App\Interfaces;

interface FruitRepositoryInterface
{
    public function  index();

    public function  show(int $id);

    public  function  getFruitByCategory(int $category_id);

    public function  store(array $fruitDetail);


}
