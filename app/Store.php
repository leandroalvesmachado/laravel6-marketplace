<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Store extends Model
{
    use HasSlug;
    
    // de forma automatica o laravel procura: store = stores
    protected $table = 'stores';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'phone', 'mobile_phone', 'slug', 'logo'
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

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

    public function orders()
    {
        return $this->belongsToMany('App\UserOrder', 'order_store', 'store_id', 'order_id');
    }
}
