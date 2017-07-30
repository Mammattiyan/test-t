<?php

namespace App\Modules\Profile\Models;

use Illuminate\Database\Eloquent\Model;

class Marital_status extends Model
{
    protected $table='marital_status';
    protected $guarded = [];
    protected $connection = 'mysql2';
}
