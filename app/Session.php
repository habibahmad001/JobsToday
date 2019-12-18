<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Session extends Authenticatable
{
    use Notifiable;
  public $timestamps = false;
  protected $dates = ['start_date','end_date'];

  protected $fillable = [
      'id','start_date','end_date','status'
  ];

   


}
