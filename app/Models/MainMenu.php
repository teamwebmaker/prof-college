<?php

namespace App\Models;

use App\Casts\JsonConvertCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainMenu extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'type', 'name'];
    protected  $casts = [
        'title' => JsonConvertCast::class,
    ];

    public function sub_menus()
    {
        return $this -> hasMany(SubMenu::class);
    }
}
