<?php

namespace App\Modules\Profile\Models;

use Illuminate\Database\Eloquent\Model;

class Motto extends Model
{
    
	protected $table = "motto";
	protected $fillable = ['id','motto'];
	
}
