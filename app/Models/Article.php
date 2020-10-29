<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $table = "article";

    public function categorie()
    {
        return $this->belongsTo('App\Models\Categorie','id_categorie' );
    }
    public function marque()
    {
        return $this->belongsTo('App\Models\Marque','id_marque' );
    }
}
