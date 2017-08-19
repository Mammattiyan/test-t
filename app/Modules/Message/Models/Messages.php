<?php

namespace App\Modules\Message\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Messages extends Model {

    protected $guarded = [];

    public function getCreatedAtAttribute($value) {
        return Carbon::parse($value)->diffForHumans();
    }

    public function users() {
//        return $this->belongsTo('App\Modules\Baskets\Models\Predefined_basket_items', 'predefined_basket_id', 'id');
    }
    
    public function message_details() {
        return $this->hasOne('App\Modules\Message\Models\Messages', 'id', 'max_id');
    }

    public function user_details() {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
