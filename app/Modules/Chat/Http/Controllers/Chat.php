<?php

namespace App\Modules\Chat\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class Chat extends Controller {

    public function indexAction() {
        return view('chat::index');
    }

}
