<?php

namespace App\Modules\Hangout\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Modules\Core\Http\Controllers\Core;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Modules\Hangout\Models\Hangouts as HangoutsModel;
use Illuminate\Support\Facades\DB;
use App\Modules\Hangout\Models\Recent_activity;
use App\Modules\Profile\Models\User_profile;
use App\Modules\Profile\Http\Controllers\Profile;

class Hangouts extends Controller {
    /*
     * 
     * function indexAction
     * 
     * return message list view
     * param null
     */

    public function indexAction(Request $request, $token) {
        $userId = Core::decodeIdAction($token);
        $user = User::find($userId)->toArray();
        $allData = Profile::otherProfileViewAction($userId);
        return view('hangout::hangout')->with(['user' => $user, 'token' => $token, 'fullData' => $allData['datas']]);
    }

    /*
     * 
     * function sentAction
     * 
     * hangout message sent 
     * 
     * array
     */

    public function sentAction(Request $request, $token) {
        $data = array(
            'receiver_id' => Core::decodeIdAction($token),
            'sender_id' => Auth::user()->id,
            'event' => strip_tags(input::get('event')),
            'location' => strip_tags(input::get('location')),
            'date' => strip_tags(input::get('date')),
            'time' => input::get('time'),
            'private_or_accompany' => input::get('private_accompany'),
            'family_member' => implode(',', input::get('family_member')),
        );
        $validator = Validator::make($data, [
                    'event' => 'required',
                    'location' => 'required',
                    'date' => 'required',
                    'time' => 'required',
                    'private_or_accompany' => 'required',
                    'family_member' => 'required',
        ]);

        if ($validator->fails()) {

            foreach (array_values($validator->messages()->toArray()) as $msg) {
                $error = implode(' ', $msg) . '<br>';
            }
            return response()->json(['status' => 0, 'msg' => $error]);
        } else {

            try {
                $query = HangoutsModel::create($data);
                if (!empty($query)) {
                    Recent_activity::create(['user_id' => $data['sender_id'], 'receiver_id' => $data['receiver_id'], 'module_name' => 'hangout', 'display_message' => 'You have sent a hangout request to']);
                    return response()->json(['status' => 1]);
                }
            } catch (\PDOException $e) {

                $error = "Not sent hangout message!";
                return response()->json(['status' => 0, 'msg' => $error]);
            } catch (\Exception $e) {
                $error = "Not sent hangout message!";
                return response()->json(['status' => 0, 'msg' => $error]);
            }
        }
    }

    /*
     * function hangoutRequestListAction
     * 
     * return hangout  list view
     * param null
     */

    public function hangoutRequestListAction(Request $request) {
        $userId = Auth::User()->id;
        $hangouts = HangoutsModel::select("hangouts.*", "users.name", 'users.profileimage','users.gender')
                        ->join('users', function($sql) use($userId) {
                            $sql->on('users.id', 'hangouts.receiver_id');
                            $sql->where('hangouts.sender_id', $userId);
                        })
                        ->distinct('id')
                        ->union(HangoutsModel::select("hangouts.*", "users.name", 'users.profileimage','users.gender')
                                ->join('users', function($sql) use($userId) {
                                    $sql->on('users.id', 'hangouts.sender_id');
                                    $sql->where('hangouts.receiver_id', $userId);
                                })
                                ->distinct('id')
                                ->orderBY('hangouts.id', 'desc'))->orderBY('id', 'desc')->get()->toArray();
        return view('hangout::index')->with(['hangouts' => $hangouts]);
    }

    /*
     * function hangoutRequestDetailsAction
     * 
     * return hangou tRequestDetails view
     * param null
     */

    public function hangoutRequestDetailsAction(Request $request) {
        $userId = Auth::User()->id;
        $hangouts = HangoutsModel::select("hangouts.*", "users.name", 'users.profileimage')
                        ->join('users', function($sql) use($userId) {
                            $sql->on('users.id', 'hangouts.receiver_id');
                            $sql->where('hangouts.sender_id', $userId);
                        })
                        ->distinct('id')
                        ->union(HangoutsModel::select("hangouts.*", "users.name", 'users.profileimage')
                                ->join('users', function($sql) use($userId) {
                                    $sql->on('users.id', 'hangouts.sender_id');
                                    $sql->where('hangouts.receiver_id', $userId);
                                })
                                ->distinct('id')
                                ->orderBY('hangouts.id', 'desc'))->orderBY('id', 'desc')->get()->toArray();

        return view('hangout::index')->with(['hangouts' => $hangouts]);
    }

}
