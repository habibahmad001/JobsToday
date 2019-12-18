<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Question extends Authenticatable
{
    use Notifiable;
    public $timestamps = false;

    protected $fillable = [
        'id','level_id','category_id','question','answer'
    ];

    public function category() {
  	return $this->belongsTo('App\Category');
   }

    public function level() {
  	return $this->belongsTo('App\Level');
   }


}
