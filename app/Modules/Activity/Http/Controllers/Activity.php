<?php

namespace App\Modules\Activity\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Modules\Hangout\Models\Hangouts;
use App\Modules\Message\Models\Dine;
use App\Modules\Message\Models\Messages;
use App\Modules\Hangout\Models\Recent_activity;
use Illuminate\Support\Facades\DB;
use App\Modules\Core\Http\Controllers\Core;

class Activity extends Controller {
    /*
     * 
     * function indexAction
     * 
     * return message list view
     * param null
     */

    public function indexAction() {
        $userId = Auth::User()->id;
        $data = [];
        $data['hangoutCount'] = Hangouts::select('sender_id')->where('hangouts.receiver_id', $userId)->count();
        $data['dineCount'] = Dine::select('sender_id')->where('dines.receiver_id', $userId)->count();
        $data['messageCount'] = Messages::select('sender')->where('messages.receiver', $userId)->count();
        $data['notification'] = $data['hangoutCount'] + $data['dineCount'] + $data['messageCount'];
        $data['recentActivityCount'] = Recent_activity::select('sender')->where('recent_activities.user_id', $userId)->count();
        $recentData = Recent_activity::select('recent_activities.*', 'users.name AS user_name', 'users.profileimage AS user_profile_pic', DB::raw('(SELECT name FROM users WHERE users.id= recent_activities.receiver_id) AS receiver_name'), DB::raw('(SELECT profileimage FROM users WHERE users.id= recent_activities.receiver_id) AS receiver_profile_pic'))
                ->join('users', 'users.id', 'recent_activities.user_id')
                ->where('recent_activities.user_id', $userId)
                ->orWhere('recent_activities.receiver_id', $userId)
                ->take(5)
                ->get()
                ->toArray();

        return view('activity::index')->with(['data' => $data, 'recentData' => $recentData, 'userId' => $userId, 'token' => Core::encodeIdAction($userId)]);
    }

}
