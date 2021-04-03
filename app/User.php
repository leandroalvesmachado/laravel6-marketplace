<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     * Os atributos são ocultados para os resultados (consultas).
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     * Os atributos são convertidos em tipos nativos determinados.
     * integer, float, boolean, datetime
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function store()
    {
        return $this->hasOne('App\Store');
    }

    public function orders()
    {
        return $this->hasMany('App\UserOrder');
    }

    // 1:1 - Um pra Um (Usuario e Loja)
    // 1:N - Um pra Muitos (Loja e Produtos)
    // N:N - Muitos pra Muitos (Produtos e Categorias)
}
