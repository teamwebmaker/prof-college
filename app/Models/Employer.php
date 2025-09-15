<?php

namespace App\Models;

use App\Casts\JsonConvertCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    use HasFactory;
    protected  $fillable = ['title', 'image', 'url'];
    protected  $casts = [
        'title' => JsonConvertCast::class,
    ];
}
