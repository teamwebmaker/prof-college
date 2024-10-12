<?php

namespace App\Models;

use App\Casts\JsonConvertCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    protected $fillable = ['full_name', 'position', 'image','email'];
    protected  $casts = [
        'full_name' => JsonConvertCast::class,
        'position' => JsonConvertCast::class,
    ];
}
