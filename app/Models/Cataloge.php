<?php

namespace App\Models;

use App\Casts\JsonConvertCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cataloge extends Model
{
  protected $fillable = ['title', 'file'];
  protected  $casts = [
    'title' => JsonConvertCast::class,
    'file' => JsonConvertCast::class,
  ];
  use HasFactory;
}
