<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pets extends Model
{
    protected $table = "pets";
	protected $fillable = ['id','name'];
}
