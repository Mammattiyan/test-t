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

class Hangouts extends Controller {
    /*
     * 
     * function indexAction
     * 
     * return message list view
     * param null
     */

    public function indexAction(Request $request, $token) {
        return view('hangout::hangout')->with(['token' => $token]);
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
            'private' => input::get('private'),
            'accompany' => input::get('accompany'),
            'family_member' => input::get('family_member'),
        );
        $validator = Validator::make($data, [
                    'event' => 'required',
                    'location' => 'required',
                    'date' => 'required',
                    'time' => 'required',
                    'private' => 'required',
                    'accompany' => 'required',
                    'family_member' => 'required|integer',
        ]);

        if ($validator->fails()) {

            foreach (array_values($validator->messages()->toArray()) as $msg) {
                $error = implode(' ', $msg) . '<br>';
            }
            return view('hangout::hangout')->with(['token' => $token, 'data' => $data, 'errors' => $validator->errors()->all()]);
        } else {
            try {
                $query = HangoutsModel::create($data);
                if (!empty($query)) {
                    return view('hangout::hangout')->with(['token' => $token, 'status' => '1']);
                }
            } catch (\PDOException $e) {

                $error[0] = "Not sent hangout message!";
                return view('hangout::hangout')->with(['token' => $token, 'errors' => $error]);
            } catch (\Exception $e) {
                $error[0] = "Not sent hangout message!";
                return view('hangout::hangout')->with(['token' => $token, 'errors' => $error]);
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
