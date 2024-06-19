<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FruitInvoice extends Model
{
    protected $table = 'fruit_invoice';

    public $timestamps = false;

    protected $fillable = [
        'Invoice_ID', 'Fruit_ID', 'Quantity', 'Amount'
    ];

    // Define relationships if any (e.g., belongsTo, hasMany)
    public function fruit()
    {
        return $this->belongsTo(Fruit::class, 'Fruit_ID', 'Fruit_ID');
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'Invoice_ID', 'Invoice_ID');
    }
}
