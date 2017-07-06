<?php

namespace App\Modules\Profile\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\User;
use Illuminate\Support\Facades\Crypt;
use App\Modules\Core\Http\Controllers\Core;

class Profile extends Controller {
    /*
     * 
     * function indexAction
     * 
     * return message list view
     * param null
     */

    public function indexAction() {
        return view('profile::profile');
    }

    /*
     * 
     * function userProfileViewAction
     * 
     * return selected user profile view
     * param null
     */

    public function userProfileViewAction() {
        $userId = Input::get('user_id');
        $user = User::find($userId)->toArray();
        $user['id'] = Core::encodeIdAction($userId);
        return view('profile::user_profile')->with('user', $user);
    }

    /*
     * 
     * function userMessageViewAction
     * 
     * return selected user message view
     * param null
     */

    public function userMessageViewAction(Request $request, $token) {
        $userId = Core::decodeIdAction($token);
    }

}
