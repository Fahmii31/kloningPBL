<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    protected $primaryKey = 'order_code'; //  Sesuai dengan migration
    public $incrementing = false;         //  Karena bukan auto-increment
    protected $keyType = 'string';        //  Karena tipe string

    protected $fillable = [
        'order_code',
        'user_id',
        'total_price',
        'payment_method',
        'payment_proof',
        'status',
    ];

    // ✅ Relasi ke User (gunakan user_id)
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    // ✅ Relasi ke OrderItem
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'order_code', 'order_code');
    }
}
