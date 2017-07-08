<?php

namespace App\Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class Core extends Controller {
    /*
     * 
     * function encodeIdAction
     * 
     * for encodeing id
     * param Id
     */

    public static function encodeIdAction($id) {
        return base64_encode($id . '#' . Carbon::now());
    }
    /*
     * 
     * function encodeIdAction
     * 
     * for encodeing id
     * param Id
     */

    public static function decodeIdAction($data) {
        return explode("#",base64_decode($data))[0];
    }

}
