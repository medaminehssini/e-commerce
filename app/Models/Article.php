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


    public function promotion()
    {
        return $this->belongsToMany('App\Models\Promotion' , 'ligne_promotion' ,'id_article',  'id_promotion' )->withPivot('qty', 'taux' , 'created_at');
    }
    public function commande()
    {
        return $this->belongsToMany('App\Models\Commande' , 'ligne_commande' ,'id_article' ,  'id_commande' )->withPivot('qty' );
    }


    public function commentaire()
    {
        return $this->belongsToMany('App\Models\User' , 'commentaire' ,'id_article',  'id_client' )->withPivot('rate', 'description' , 'created_at');
    }


}
