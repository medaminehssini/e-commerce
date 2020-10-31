<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
    protected $table = "promotion";
    public $timestamps = false;

    public function article()
    {
        return $this->belongsToMany('App\Models\Article' , 'ligne_promotion' ,  'id_promotion','id_article' )->withPivot('qty', 'taux' , 'created_at');
    }

}
