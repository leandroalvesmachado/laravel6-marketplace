<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    // de forma automatica o laravel procura: store = stores
    protected $table = 'stores';
}
