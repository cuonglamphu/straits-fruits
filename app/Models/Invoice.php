<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{

    public $timestamps = true;

    protected $table = 'invoices';

    protected $fillable = [
        'Customer_Name', 'Total'
    ];

    // Define relationships if any (e.g., hasMany, belongsTo)
    public function fruits()
    {
        return $this->belongsToMany(Fruit::class, 'fruit_invoice', 'Invoice_ID', 'Fruit_ID')
            ->withPivot('Quantity', 'Amount');
    }
}
