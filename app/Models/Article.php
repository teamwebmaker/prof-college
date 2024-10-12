<?php

namespace App\Models;

use App\Casts\JsonConvertCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'image','uuid', 'embed', 'category_id'];
    protected  $casts = [
        'title' => JsonConvertCast::class,
        'description' => JsonConvertCast::class
    ];

    public function docs()
    {
        return $this->hasMany(Doc::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
