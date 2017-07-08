<?php

namespace App\Modules\Message\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Messages extends Model
{
    protected $guarded = [];
    
     public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }
}
