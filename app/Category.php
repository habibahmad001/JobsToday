<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Category extends Authenticatable
{
    use Notifiable;
    public $timestamps = false;

    protected $fillable = [
        'id','category',
    ];


}
