<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'code_product', 'stock'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_code_product', 'code_product');
    }
}
