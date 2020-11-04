<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marque extends Model
{
    use HasFactory;
    protected $table = "marque";
    public $timestamps = false;

    public function article()
    {
        return $this->hasMany('App\Models\Product' , 'id_marque');
    }
}
