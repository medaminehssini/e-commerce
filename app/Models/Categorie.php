<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;
    protected $table = "categorie";
    public $timestamps = false;



    public function article()
    {
        return $this->hasMany('App\Models\Article' , 'id_categorie');
    }
    public function categorie()
    {
        return $this->hasMany('App\Models\Categorie','id_categorie' );
    }

}
