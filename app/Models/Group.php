<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $fillable = ['number', 'table', 'profession_id'];
    public function profession()
    {
        return $this -> belongsTo(Profession::class);
    }
}
