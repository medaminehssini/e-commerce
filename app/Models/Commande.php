<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;
    protected $table = "commande";
    public $timestamps = false;

    public function client()
    {
        return $this->belongsTo('App\Models\User','id_client' );
    }
    public function coupon()
    {
        return $this->belongsTo('App\Models\Coupon','id_coupon' );
    }
    public function article()
    {
        return $this->belongsToMany('App\Models\Article' , 'ligne_commande' ,  'id_commande','id_article' )->withPivot('qty' );
    }
}
