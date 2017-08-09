<?php

namespace App\Modules\Profile\Models;

use Illuminate\Database\Eloquent\Model;

class Traits_selected extends Model {

    protected $table = 'traits_selected';
    protected $guarded = [];


    public function traits() {
        return $this->hasMany('App\Modules\Profile\Models\Traits', 'category', 'category');
    }

}
