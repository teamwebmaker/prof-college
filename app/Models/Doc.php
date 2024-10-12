<?php

namespace App\Models;

use App\Casts\JsonConvertCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doc extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'src', 'type', 'article_id'];
    protected  $casts = [
        'title' => JsonConvertCast::class,
    ];
    public function article()
    {
        return $this->belongsTo(Article::class);
    }

}
