<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'body', 'price', 'slug'
    ];

    public function store()
    {
        return $this->belongsTo('App\Store');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }
}
