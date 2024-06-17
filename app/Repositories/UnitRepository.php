<?php


namespace App\Repositories;
use App\Interfaces\UnitRepositoryInterface;
use App\Models\Unit;

class UnitRepository implements UnitRepositoryInterface
{
    public function index()
    {
        return Unit::all();
    }

    public function show($id)
    {
        return Unit::find($id);
    }

    public function store(array $data)
    {
        return Unit::create($data);
    }

    public function update(array $data, $id)
    {
        $unit = Unit::find($id);
        return $unit->update($data);
    }
}
