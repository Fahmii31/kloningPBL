<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $primaryKey = 'code';  // primary key adalah 'code'
    public $incrementing = false;    // karena string, bukan auto increment
    protected $keyType = 'string';   // tipe primary key string

    protected $fillable = ['code', 'name', 'status'];
}
