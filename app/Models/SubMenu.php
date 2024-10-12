<?php

namespace App\Models;

use App\Casts\JsonConvertCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubMenu extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'name', 'href'];
    protected  $casts = [
        'title' => JsonConvertCast::class,
    ];
    public function main_menu()
    {
        return $this -> belongsTo(SubMenu::class);
    }
}
