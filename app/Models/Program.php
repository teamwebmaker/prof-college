<?php

namespace App\Models;

use App\Casts\JsonConvertCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'file', 'category'];
    protected  $casts = [
        'title' => JsonConvertCast::class,
        'file' => JsonConvertCast::class
    ];

}
