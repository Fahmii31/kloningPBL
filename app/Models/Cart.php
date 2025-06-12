<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    protected $primaryKey = 'code_cart';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'code_cart',
        'user_email',
        'code_product',
        'quantity',
        'subtotal',
    ];

    // Relasi ke User (berdasarkan email)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_email', 'email');
    }

    // Relasi ke Product
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'code_product', 'code_product');
    }
}
