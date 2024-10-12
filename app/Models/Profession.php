<?php

namespace App\Models;

use App\Casts\JsonConvertCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'type','condition','groups','level', 'credits','custom_credits', 'duration', 'custom_duration'];
    protected  $casts = [
        'title' => JsonConvertCast::class,
        'type' => JsonConvertCast::class,
        'condition' => JsonConvertCast::class,
    ];

    public function groups()
    {
        return $this -> hasMany(Group::class);
    }
}
