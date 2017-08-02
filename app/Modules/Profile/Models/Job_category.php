<?php

namespace App\Modules\Profile\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Profile\Models\Jobs;

class Job_category extends Model
{
    protected $table='job_category';
    protected $guarded = [];
    protected $connection = 'mysql2';
    
    public function jobs() {
        return $this->hasMany('App\Modules\Profile\Models\Jobs', 'job_category_id', 'job_category_id');
   
    }
}
