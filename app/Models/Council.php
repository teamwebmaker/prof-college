<?php

namespace App\Models;

use App\Casts\JsonConvertCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Council extends Model
{
    use HasFactory;
    protected $fillable = ['first_name', 'last_name', 'representative'];
    protected  $casts = [
        'first_name' => JsonConvertCast::class,
        'last_name' => JsonConvertCast::class,
        'representative' => JsonConvertCast::class
    ];
}
