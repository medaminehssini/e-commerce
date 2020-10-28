<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;
    protected $table = "categorie";


    public function product()
    {
        return $this->hasMany('App\Models\Product' , 'categorie');
    }
}
