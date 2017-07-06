<?php

namespace App\Modules\Search\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class Search extends Controller
{
    /*
     * 
     * function indexAction
     * 
     * return message list view
     * param null
     */

    public function searchAction() {
        return view('search::search_result');
    }
}
