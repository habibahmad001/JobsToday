<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Level extends Authenticatable
{
    use Notifiable;
    public $timestamps = false;

    protected $fillable = [
        'id','level','name'
    ];


}
