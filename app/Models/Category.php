<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'Category_Name',
    ];

    // Define relationships if any (e.g., hasMany, belongsTo)
    public function fruits()
    {
        return $this->hasMany(Fruit::class, 'Category_ID', 'Category_ID');
    }
}
