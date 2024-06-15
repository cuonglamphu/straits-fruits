<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'units';

    protected $fillable = [
        'Unit_Name',
    ];

    // Define relationships if any (e.g., hasMany, belongsTo)
    public function fruits()
    {
        return $this->hasMany(Fruit::class, 'Unit_ID', 'Unit_ID');
    }
}
