<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = "client" ;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function commande()
    {
        return $this->hasMany('App\Models\Commande' , 'id_client');
    }


    public function commentaire()
    {
        return $this->belongsToMany('App\Models\Article' , 'commentaire' ,  'id_client' ,'id_article' )->withPivot('rate', 'description' , 'created_at');
    }

    public function wishList()
    {
        return $this->belongsToMany('App\Models\Article' , 'wishlist' ,  'id_client' ,'id_article' )->withPivot('created_at');
    }
    public function verifyUser()
    {
      return $this->hasOne('App\Models\VerifyUser');
    }
}
