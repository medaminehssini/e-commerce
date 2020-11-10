<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LigneCommande extends Model
{
    use HasFactory;
    protected $table = "ligne_commande";
    public $timestamps = false;

    public function commande()
    {
        return $this->belongsTo('App\Models\Commande' , 'id_commande');
    }
}
