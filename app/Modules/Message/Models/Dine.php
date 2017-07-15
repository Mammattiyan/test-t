<?php

namespace App\Modules\Message\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Dine extends Model {

    protected $guarded = [];
    protected $table = 'dines';

    public function getCreatedAtAttribute($value) {
        return Carbon::parse($value)->diffForHumans();
    }


}
