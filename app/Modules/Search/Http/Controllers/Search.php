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
        $users = User::select('users.*')
                ->join('user_profile', 'user_profile.user_id', 'users.id')
                ->leftJoin('gender_preference', 'gender_preference.id', 'user_profile.gender_preference_id')
                ->leftJoin('marital_status', 'marital_status.id', 'user_profile.marital_status_id')
                ->leftJoin('ethnic_origin', 'ethnic_origin.id', 'user_profile.ethnic_origin_id')
                ->leftJoin('qualification', 'qualification.id', 'user_profile.qualification_id')
                ->leftJoin('job_category', 'job_category.id', 'user_profile.job_category_id')
                ->leftJoin('smoke', 'smoke.id', 'user_profile.smoke_id')
                ->leftJoin('drink', 'drink.id', 'user_profile.drink_id')
                ->leftJoin('pet_lover', 'pet_lover.id', 'user_profile.pet_lover_id')
                ->leftJoin('zodiac_signs', 'zodiac_signs.id', 'user_profile.zodiac_sign_id')
                ->leftJoin('countries', 'countries.id', 'user_profile.ethnic_origin_id')
                ->where(function($sql) use ($name) {
                    $sql->where('users.name', 'like', $name . '%');
                    $sql->orWhere('users.email', 'like', $name . '%');
                    $sql->orWhere('users.username', 'like', $name . '%');
                    $sql->orWhere('user_profile.motto', 'like', $name . '%');
                    $sql->orWhere('zodiac_signs.zodiac_name', 'like', $name . '%');
                })
                ->where('users.id', '<>', $userId)
                ->get();
                
//                dd($users->toArray());
        $data = [];
        $data['result'] = $users;
        return view('search::search_result')->with($data);
    }

}
