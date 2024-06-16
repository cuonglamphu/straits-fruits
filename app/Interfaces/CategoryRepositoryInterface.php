<?php

namespace App\Interfaces;

interface CategoryRepositoryInterface
{
    public function  index();
    public function  store(array $categoryDetail);
    public function  show(int $id);
}
