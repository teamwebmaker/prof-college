<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    use HasFactory;
    protected $fillable = ['photo_gallery_id', 'image'];
    public function photo_gallery()
    {
        return $this->belongsTo(PhotoGallery::class);
    }
}
