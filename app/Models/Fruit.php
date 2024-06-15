<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fruit extends Model
{
    protected $table = 'fruits';

    protected $fillable = [
        'Fruit_Name', 'Price', 'Category_ID', 'Unit_ID'
    ];

    // Define relationships if any (e.g., belongsTo, hasMany)
    public function category()
    {
        return $this->belongsTo(Category::class, 'Category_ID', 'Category_ID');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'Unit_ID', 'Unit_ID');
    }

    public function invoices()
    {
        return $this->belongsToMany(Invoice::class, 'fruit_invoice', 'Fruit_ID', 'Invoice_ID')
            ->withPivot('Quantity', 'Amount');
    }
}
