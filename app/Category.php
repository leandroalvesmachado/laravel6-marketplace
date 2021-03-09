<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'slug'
    ];

    public function products()
    {
        // segundo parametro é a tabela
        return $this->belongsToMany('App\Product', 'category_product');
    }
}
