<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    // de forma automatica o laravel procura: store = stores
    protected $table = 'stores';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'phone', 'mobile_phone', 'slug'
    ];

    // de forma automatica o laravel procura pela fk user_id
    public function user()
    {
        return $this->belongsTo('App\User');
        // caso a fk possua outro nome
        // return $this->belongsTo('App\User', 'usuario_id');
    }

    public function products()
    {
        return $this->hasMany('App\Product');
    }
}
