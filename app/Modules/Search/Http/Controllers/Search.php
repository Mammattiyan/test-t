<?php

namespace App\Modules\Search\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\User;
use Illuminate\Support\Facades\Auth;

class Search extends Controller {
    /*
     * 
     * function indexAction
     * 
     * return message list view
     * param null
     */

    public function searchAction() {
        $userId = Auth::user()->id;

        $name = Input::get('name');
        $users = User::select()
                ->where(function($sql) use ($name) {
                    $sql->where('name', 'like', $name . '%');
                })
                ->where('id','<>',$userId)
                ->get();
        $data = [];
        $data['result'] = $users;
        return view('search::search_result')->with($data);
    }

}
