<?php

namespace App\Modules\Hangout\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Hangouts extends Model {

    protected $guarded = [];

    public function getCreatedAtAttribute($value) {
        return Carbon::parse($value)->diffForHumans();
    }

}
