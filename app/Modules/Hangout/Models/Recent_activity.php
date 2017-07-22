<?php

namespace App\Modules\Hangout\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Recent_activity extends Model {

    protected $guarded = [];
    protected $table = 'recent_activities';

    public function getCreatedAtAttribute($value) {
        return Carbon::parse($value)->diffForHumans();
    }

}
