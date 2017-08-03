<?php

namespace App\Modules\Dine\Http\Controllers;

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
use App\Modules\Message\Models\Dine as DineModel;
use App\Modules\Hangout\Models\Recent_activity;
use App\Modules\Profile\Models\User_profile;

class Dine extends Controller {
    /*
     * 
     * function indexAction
     * 
     * Dine html view
     * param null
     */

    public function indexAction(Request $request, $token) {

        $userId = Core::decodeIdAction($token);
        $user = User::find($userId)->toArray();
             $fullData = User_profile::select('user_profile.*', 'gender_preference.gender_preference_name', 'marital_status.marital_status', 'ethnic_origin.ethnic_origin_name', 'qualification.qualification_name', 'job_category.category_name', 'smoke.name as smoke_status', 'drink.name as drink_status'
                                    , 'pet_lover.name as pet_lover', 'users.name as full_name', 'users.place as location', 'users.profileimage')
                            ->leftJoin('gender_preference', 'gender_preference.id', 'user_profile.gender_preference_id')
                            ->leftJoin('marital_status', 'marital_status.id', 'user_profile.marital_status_id')
                            ->leftJoin('ethnic_origin', 'ethnic_origin.id', 'user_profile.ethnic_origin_id')
                            ->leftJoin('qualification', 'qualification.id', 'user_profile.qualification_id')
                            ->leftJoin('job_category', 'job_category.id', 'user_profile.job_category_id')
                            ->leftJoin('smoke', 'smoke.id', 'user_profile.smoke_id')
                            ->leftJoin('drink', 'drink.id', 'user_profile.drink_id')
                            ->leftJoin('pet_lover', 'pet_lover.id', 'user_profile.pet_lover_id')
                            ->join('users', 'users.id', 'user_profile.user_id')
                            ->where('user_profile.user_id', $userId)
                            ->first()->toArray();
        return view('dine::index')->with(['user' => $user, 'token' => $token,'fullData'=>$fullData]);
    }

    /*
     * 
     * function dineAction
     * 
     * dine sent Action
     * param null
     */

    public function dineSentAction(Request $request, $token) {

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
                    'family_member' => 'required',
        ]);
        $user = User::find(Auth::user()->id)->toArray();
        if ($validator->fails()) {

            foreach (array_values($validator->messages()->toArray()) as $msg) {
                $error = implode(' ', $msg) . '<br>';
            }
            return view('dine::index')->with(['token' => $token, 'user'=>$user,'data' => $data, 'errors' => $validator->errors()->all()]);
        } else {

            $query = DineModel::create($data);
            if (!empty($query)) {
                Recent_activity::create(['user_id' => $data['sender_id'], 'receiver_id' => $data['receiver_id'], 'module_name' => 'dine', 'display_message' => 'You have a dining  request to']);
                return view('dine::index')->with(['token' => $token, 'user'=>$user, 'status' => '1']);
            }
            try {
                
            } catch (\PDOException $e) {

                $error[0] = "Not sent dine message!";
                return view('dine::index')->with(['token' => $token, 'errors' => $error]);
            } catch (\Exception $e) {
                $error[0] = "Not sent dine message!";
                return view('dine::index')->with(['token' => $token, 'errors' => $error]);
            }
        }
    }

    /*
     * 
     * function dineListAction
     * 
     * dine List Action
     * param null
     */

    public function dineListAction() {
        $userId = Auth::User()->id;
        $dines = DineModel::select("dines.*", "users.name", 'users.profileimage')
                        ->join('users', function($sql) use($userId) {
                            $sql->on('users.id', 'dines.receiver_id');
                            $sql->where('dines.sender_id', $userId);
                        })
                        ->distinct('id')
                        ->union(DineModel::select("dines.*", "users.name", 'users.profileimage')
                                ->join('users', function($sql) use($userId) {
                                    $sql->on('users.id', 'dines.sender_id');
                                    $sql->where('dines.receiver_id', $userId);
                                })
                                ->distinct('id')
                                ->orderBY('dines.id', 'desc'))->orderBY('id', 'desc')->get()->toArray();

        return view('dine::dineList')->with(['dines' => $dines, 'token' => Core::encodeIdAction($userId)]);
    }

}
