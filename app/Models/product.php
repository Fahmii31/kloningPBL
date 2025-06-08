<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'code_product';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'code_product',
        'name',
        'category_code',
        'merk_code',
        'description',
        'price',
        'warranty',
        'image',
    ];

    public function stock()
    {
        return $this->hasOne(Stock::class, 'code_product', 'code_product');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_code', 'code');
    }

    public function merk()
    {
        return $this->belongsTo(Merk::class, 'merk_code', 'code');
    }
}
