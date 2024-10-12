<?php

namespace App\Models;

use App\Casts\JsonConvertCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoGallery extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'uuid', 'gallery_images'];
    protected  $casts = [
        'title' => JsonConvertCast::class,
    ];
    public function gallery_images()
    {
        return $this->hasMany(GalleryImage::class);
    }
}
