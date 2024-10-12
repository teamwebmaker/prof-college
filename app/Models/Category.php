<?php

namespace App\Models;

use App\Casts\JsonConvertCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['title'];
    protected  $casts = [
        'title' => JsonConvertCast::class,
    ];
    public function articles()
    {
        return $this -> hasMany(Article::class);
    }
}
