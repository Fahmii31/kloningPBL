<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'site_name', 'copyright', 'address',
        'email', 'phone', 'description',
    ];
}
