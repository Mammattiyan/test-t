<?php

namespace App\Modules\Profile\Models;

use Illuminate\Database\Eloquent\Model;

class Mottos extends Model
{
    protected $table='mottos';
    protected $guarded = [];
    protected $connection = 'mysql2';
}
