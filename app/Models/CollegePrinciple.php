<?php

namespace App\Models;

use App\Casts\JsonConvertCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollegePrinciple extends Model
{
    use HasFactory;
    
    protected $fillable = ['mission', 'vision', 'principles'];
    
    protected $casts = [
        'mission' => JsonConvertCast::class,
        'vision' => JsonConvertCast::class,
        'principles' => JsonConvertCast::class,
    ];
}
