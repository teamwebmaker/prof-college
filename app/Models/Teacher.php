<?php

namespace App\Models;

use App\Casts\JsonConvertCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable = ['full_name', 'subject', 'image'];
    protected  $casts = [
        'full_name' => JsonConvertCast::class,
        'subject' => JsonConvertCast::class
    ];
}
