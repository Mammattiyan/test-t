<?php

namespace App\Modules\Profile\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\User;
use Illuminate\Support\Facades\Crypt;
use App\Modules\Core\Http\Controllers\Core;
use App\Modules\Message\Models\Messages;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $user = User::find($userId)->toArray();
        $user['id'] = Core::encodeIdAction($userId);
        $message = Messages::select('messages.*', 'users.name', 'users.profileimage', DB::raw('IF(sender='.Auth::user()->id.',"right","left") as position'))
                ->join('users', 'users.id', 'messages.sender')
                ->where(['sender'=>Auth::user()->id, 'receiver' => $userId])
                ->orWhere(['receiver'=>Auth::user()->id, 'sender' => $userId])
                ->orderBy('messages.id', 'asc')
                ->get();
        return view('profile::user_messages')->with(['user' => $user, 'message' => $message, 'my' => Auth::user()->id]);
    }
    
    /*
     * 
     * function sendMessageAction
     * 
     * return json
     * param null
     */

    public function sendMessageAction() {
        $receiver = Input::get('receiver');
        $receiver = Core::decodeIdAction($receiver);
        $message = Input::get('message');
        Messages::create(['sender' => Auth::user()->id,'receiver' => $receiver, 'message' => $message]);
        $user = User::find(Auth::user()->id)->toArray();
        $data = ['message' => $message, 'name' => $user['name']];
        return response()->json($data);
        
    }

}
