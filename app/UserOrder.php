<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserOrder extends Model
{
    protected $table = 'user_orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reference', 'pagseguro_status', 'pagseguro_code', 'store_id', 'items'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function store()
    {
        return $this->belongsTo('App\Store');
    }

    public function stores()
    {
        // model, tabela (caso nao seja no padrao laravel), coluna (caso nao seja no padrao laravel)
        return $this->belongsToMany('App\Store', 'order_store', 'order_id');
    }

}
