<?php

namespace App\Modules\Profile\Models;

use Illuminate\Database\Eloquent\Model;

class Gender_preference extends Model
{
    protected $table='gender_preference';
    protected $guarded = [];
    protected $connection = 'mysql2';
}
