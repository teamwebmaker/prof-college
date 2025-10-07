<?php

namespace App\Models;

use App\Casts\JsonConvertCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSlider extends Model
{
    use HasFactory;
    protected $fillable = ['slide', 'visible', 'sortable'];
    protected  $casts = [
        'slide' => JsonConvertCast::class,
    ];
}
