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
                ->join('user_profile', 'user_profile.user_id', 'users.id')
                ->where(function($sql) use ($name) {
                    $sql->where('users.name', 'like', $name . '%');
                })
                ->where('users.id','<>',$userId)
                ->get();
        $data = [];
        $data['result'] = $users;
        return view('search::search_result')->with($data);
    }

}
