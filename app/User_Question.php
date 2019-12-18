<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Question extends Model
{
    //
    protected $table = 'user_questions';


    public function getCreatedAtAttribute($date)
	{
	    return Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
	}

	public function getUpdatedAtAttribute($date)
	{
	    return Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
	}
}
