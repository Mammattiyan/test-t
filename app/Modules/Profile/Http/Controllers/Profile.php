<?php

namespace App\Modules\Profile\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\User;
use Illuminate\Support\Facades\Crypt;
use App\Modules\Core\Http\Controllers\Core;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use App\Modules\Message\Models\Messages;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Modules\Profile\Models\Userprofile;
use App\Modules\Hangout\Models\Hangouts;
use App\Modules\Message\Models\Dine;
use App\Modules\Hangout\Models\Recent_activity;
use App\Modules\Profile\Models\Mottos;
use App\Modules\Profile\Models\Gender_preference;
use App\Modules\Profile\Models\Marital_status;
use App\Modules\Profile\Models\Ethnic_origin;
use App\Modules\Profile\Models\Job_category;
use App\Modules\Profile\Models\Jobs;
use App\Modules\Profile\Models\Partner_grew_up_country;
use App\Modules\Profile\Models\Partner_job_category;
use App\Modules\Profile\Models\Partner_living_country;
use App\Modules\Profile\Models\Partner_living_state;
use App\Modules\Profile\Models\Partner_qualification;
use App\Modules\Profile\Models\Partner_marital_status;
use App\Modules\Profile\Models\Pet_lover;
use App\Modules\Profile\Models\Qualification;
use App\Modules\Profile\Models\Smoke;
use App\Modules\Profile\Models\Traits;
use App\Modules\Profile\Models\User_profile;
use App\Modules\Profile\Models\Zodiac_signs;
use App\Modules\Profile\Models\Module_documents;
use App\Modules\Profile\Models\Drink;
use App\Modules\Profile\Models\Countries;
use App\Modules\Profile\Models\States;

class Profile extends Controller {
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
        $data['hangoutCount'] = count(Hangouts::select('sender_id')->where('hangouts.receiver_id', $userId)->groupBy('sender_id')->get());
        $data['dineCount'] = count(Dine::select('sender_id')->where('dines.receiver_id', $userId)->groupBy('sender_id')->get());
        $data['messageCount'] = count(Messages::select('sender')->where('messages.receiver', $userId)->groupBy('sender')->get());
        $recentData = Recent_activity::select('recent_activities.*', 'users.name AS user_name', 'users.profileimage AS user_profile_pic', DB::raw('(SELECT name FROM users WHERE users.id= recent_activities.receiver_id) AS receiver_name'), DB::raw('(SELECT profileimage FROM users WHERE users.id= recent_activities.receiver_id) AS receiver_profile_pic'))
                ->join('users', 'users.id', 'recent_activities.user_id')
                ->where('recent_activities.user_id', $userId)
                ->orWhere('recent_activities.receiver_id', $userId)
                ->take(5)
                ->get()
                ->toArray();

        return view('profile::profile')->with(['data' => $data, 'recentData' => $recentData, 'userId' => $userId, 'token' => Core::encodeIdAction($userId)]);
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
        $gallery = [];
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
        $gallery['images'] = Module_documents::select('id', 'path')->where('parent_id', $user['id'])->where('module_name', 'user_images')->get()->toArray();
        $gallery['videos'] = Module_documents::select('id', 'path')->where('parent_id', $user['id'])->where('module_name', 'user_videos')->get()->toArray();
        return view('profile::user_profile')->with(['user' => $user, 'fullData' => $fullData, 'token' => Core::encodeIdAction($userId), 'gallery' => $gallery]);
    }

    /*
     * 
     * function userProfileViewAction
     * 
     * return selected user profile view
     * param null
     */

    public function userProfileViewByTokenAction($token) {
        $userId = Core::decodeIdAction($token);
        $user = User::find($userId)->toArray();
        $user['id'] = $token;
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
        $gallery = [];
        $gallery['images'] = Module_documents::select('id', 'path')->where('parent_id', $user['id'])->where('module_name', 'user_images')->get()->toArray();
        $gallery['videos'] = Module_documents::select('id', 'path')->where('parent_id', $user['id'])->where('module_name', 'user_videos')->get()->toArray();
        return view('profile::user_profile')->with(['user' => $user, 'fullData' => $fullData, 'token' => $token, 'gallery' => $gallery]);
    }

    /*
     * 
     * function hangoutRequestViewAction
     * 
     * return selected user profile view
     * param null
     */

    public function hangoutRequestViewAction($token) {
        $userId = Core::decodeIdAction($token);
        $user = User::find($userId)->toArray();
        return view('profile::hangout_send_request')->with(['user' => $user, 'token' => $token]);
    }

    /*
     * 
     * function userMessageViewAction
     * 
     * return selected user message view
     * param null
     */

    public function userMessageViewAction(Request $request, $token) {



        if (isset($token)) {
            $userId = Core::decodeIdAction($token);
            $user = User::find($userId)->toArray();
            $user['id'] = Core::encodeIdAction($userId);
            $message = Messages::select('messages.*', 'users.name', 'users.profileimage', DB::raw('IF(sender=' . Auth::user()->id . ',"right","left") as position'))
                    ->join('users', 'users.id', 'messages.sender')
                    ->where(['sender' => Auth::user()->id, 'receiver' => $userId])
                    ->orWhere(['receiver' => Auth::user()->id, 'sender' => $userId])
                    ->orderBy('messages.id', 'asc')
                    ->get();

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

            return view('profile::user_messages')->with(['user' => $user, 'token' => $token, 'message' => $message, 'my' => Auth::user()->id, 'fullData' => $fullData]);
        } else {
            return redirect('message');
        }
    }

    /*
     * 
     * function allMessageViewAction
     * 
     * return selected user message view
     * param null
     */

    public function allMessageViewAction(Request $request) {
        return redirect('message');
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
        Messages::where(['sender' => Auth::user()->id, 'receiver' => $receiver])->orWhere(['sender' => $receiver, 'receiver' => Auth::user()->id])->update(['last_status' => 0]);
        Messages::create(['sender' => Auth::user()->id, 'receiver' => $receiver, 'message' => $message]);
        $user = User::find(Auth::user()->id)->toArray();
        $data = ['message' => $message, 'name' => $user['name']];
        return response()->json($data);
    }

    /*
     * 
     * function profileImageUploadAction
     * 
     * user prfile image upload action
     * 
     * param: image
     * 
     * Return: uploaded image url     
     */

    public function profileImageUploadAction(Request $request) {
        $destinationPath = 'uploads/users';
        if ($request->file('img')->isValid()) {
            $extension = Input::file('img')->getClientOriginalExtension(); // getting image extension
            $fileName = md5(\Carbon\Carbon::now() . rand(11111, 99999)) . '.' . $extension; // renameing image
            Input::file('img')->move($destinationPath, $fileName);
            list($width, $height) = getimagesize($destinationPath . '/' . $fileName);
            $response = array(
                "status" => 'success',
                "url" => URL::to($destinationPath . '/' . $fileName),
                "width" => $width,
                "height" => $height
            );
        } else {
            $response = array(
                "status" => 'error',
                "message" => 'something went wrong, most likely file is to large for upload. check upload_max_filesize, post_max_size and memory_limit in you php.ini',
            );
        }
        return response()->json($response);
    }

    /*
     * 
     * function profileImageCropAction
     * 
     * image croping function
     * 
     * param: image
     * 
     * Return: croped image url
     */

    public function profileImageCropAction(Request $request) {
        $destinationPath = 'uploads/users/';
        $imgUrl = Input::get('imgUrl');
// original sizes
        $imgInitW = Input::get('imgInitW');
        $imgInitH = Input::get('imgInitH');
// resized sizes
        $imgW = Input::get('imgW');
        $imgH = Input::get('imgH');
// offsets
        $imgY1 = Input::get('imgY1');
        $imgX1 = Input::get('imgX1');
// crop box
        $cropW = Input::get('cropW');
        $cropH = Input::get('cropH');
// rotation angle
        $angle = Input::get('rotation');

        $jpegQuality = 100;
        $fileName = $destinationPath . rand();
        $outputFilename = $fileName;
        $what = getimagesize($imgUrl);

        switch (strtolower($what['mime'])) {
            case 'image/png':
                $img_r = imagecreatefrompng($imgUrl);
                $source_image = imagecreatefrompng($imgUrl);
                $type = '.png';
                break;
            case 'image/jpeg':
                $img_r = imagecreatefromjpeg($imgUrl);
                $source_image = imagecreatefromjpeg($imgUrl);
                error_log("jpg");
                $type = '.jpeg';
                break;
            case 'image/gif':
                $img_r = imagecreatefromgif($imgUrl);
                $source_image = imagecreatefromgif($imgUrl);
                $type = '.gif';
                break;
            default: die('image type not supported');
        }
        // resize the original image to size of editor
        $resizedImage = imagecreatetruecolor($imgW, $imgH);
        imagecopyresampled($resizedImage, $source_image, 0, 0, 0, 0, $imgW, $imgH, $imgInitW, $imgInitH);
        // rotate the rezized image
        $rotated_image = imagerotate($resizedImage, -$angle, 0);
        // find new width & height of rotated image
        $rotated_width = imagesx($rotated_image);
        $rotated_height = imagesy($rotated_image);
        // diff between rotated & original sizes
        $dx = $rotated_width - $imgW;
        $dy = $rotated_height - $imgH;
        // crop rotated image to fit into original rezized rectangle
        $croppedRotatedImage = imagecreatetruecolor($imgW, $imgH);
        imagecolortransparent($croppedRotatedImage, imagecolorallocate($croppedRotatedImage, 0, 0, 0));
        imagecopyresampled($croppedRotatedImage, $rotated_image, 0, 0, $dx / 2, $dy / 2, $imgW, $imgH, $imgW, $imgH);
        // crop image into selected area
        $finalImage = imagecreatetruecolor($cropW, $cropH);
        imagecolortransparent($finalImage, imagecolorallocate($finalImage, 0, 0, 0));
        imagecopyresampled($finalImage, $croppedRotatedImage, 0, 0, $imgX1, $imgY1, $cropW, $cropH, $cropW, $cropH);
        // finally output png image
        //imagepng($finalImage, $outputFilename.$type, $png_quality);
        imagejpeg($finalImage, $outputFilename . $type, $jpegQuality);
        $response = Array(
            "status" => 'success',
            "url" => URL::to($fileName . $type)
        );
        User::where('id', Auth::user()->id)->update(['profileimage' => $fileName . $type]);
        return response()->json($response);
    }

    public function selectData($list, $label) {
        $data = [];
        if (count($list) > 0) {
            foreach ($list as $val) {
                $data[$val->id] = $val->$label;
            }
        }
        return $data;
    }

    public function selectPartnerData($list, $label) {
        $data = [];
        if (count($list) > 0) {
            foreach ($list as $val) {
                $data[] = $val->$label;
            }
        }
        return $data;
    }

    public function profileEditAction(Request $request) {
        $user = Auth::user()->id;
        if (User_profile::where('user_id', $user)->count() == 0) {
            User_profile::create(['user_id' => $user]);
        }
        $data = [];
        $data['user_profiles'] = User_profile::where('user_id', $user)->first()->toArray();
//        dd($data['user_profiles']);
        $data['mottos'] = Mottos::all();
        $data['gender_preference'] = Gender_preference::all();
        $data['marital_status'] = Marital_status::all();
        $height = [];
        for ($i = 10; $i <= 210; $i++) {
            $height[$i] = $i . ' cm';
        }
        $data['height'] = $height;
        $data['ethnic_origin'] = $this->selectData(Ethnic_origin::all(), 'ethnic_origin_name');
        $data['qualification'] = Qualification::all();
        $data['partner_qualification'] = $this->selectData(Qualification::all(), 'qualification_name');
        $data['smoke'] = Smoke::all();
        $data['drink'] = Drink::all();
        $data['pet_lover'] = Pet_lover::all();
        $data['partner_marital_status'] = $this->selectData(Marital_status::all(), 'marital_status');
        $data['states'] = $this->selectData(States::all(), 'state_name');
        $data['living_country'] = $this->selectData(Countries::all(), 'name');
        $data['jobs'] = Job_category::select('id as job_category_id', 'category_name')
                        ->with(['jobs' => function($q) {
                                $q->select('id as job_id', 'job_category_id', 'job_name');
                            }])
                        ->get()->toArray();

        $data['selected_partner_grew_up_country'] = $this->selectPartnerData(Partner_grew_up_country::where('user_id', $user)->get(), 'country_id');
        $data['selected_partner_job_category'] = $this->selectPartnerData(Partner_job_category::where('user_id', $user)->get(), 'job_category_id');
        $data['selected_partner_living_country'] = $this->selectPartnerData(Partner_living_country::where('user_id', $user)->get(), 'country_id');
        $data['selected_partner_living_state'] = $this->selectPartnerData(Partner_living_state::where('user_id', $user)->get(), 'state_id');
        $data['selected_partner_marital_status'] = $this->selectPartnerData(Partner_marital_status::where('user_id', $user)->get(), 'marital_status_id');
        $data['selected_partner_qualification'] = $this->selectPartnerData(Partner_qualification::where('user_id', $user)->get(), 'qualification_id');

        return view('profile::editprofile')->with('data', $data);
    }

    public function profileUpdateAction(Request $request) {
        $user = Auth::user()->id;
        $data = Input::all();
        $values = [];
        $values["motto_id"] = $data["motto_id"];
        $values["gender_preference_id"] = $data["gender_preference_id"];
        $values["marital_status_id"] = $data["marital_status_id"];
        $values["height"] = $data["height"];
        $values["ethnic_origin_id"] = $data["ethnic_origin_id"];
        $values["qualification_id"] = $data["qualification_id"];
        $values["job_category_id"] = $data["job_category_id"];
        $values["job_title"] = $data["job_title"];
        $values["zodiac_sign_id"] = $data["zodiac_sign_id"];
        $values["smoke_id"] = $data["smoke_id"];
        $values["drink_id"] = $data["drink_id"];
        $values["pet_lover_id"] = $data["pet_lover_id"];
        $values["partner_gender"] = $data["partner_gender"];
        $values["age_from"] = $data["age_from"];
        $values["age_to"] = $data["age_to"];
        $values["height_from"] = $data["height_from"];
        $values["height_to"] = $data["height_to"];
        $values["annual_income_from"] = $data["annual_income_from"];
        $values["annual_income_to"] = $data["annual_income_to"];
        $values["partner_smoking_habit"] = $data["partner_smoking_habit"];
        $values["partner_drinking_habit"] = $data["partner_drinking_habit"];
        $values["no_of_children_lived_with"] = $data["no_of_children_lived_with"];
        $values["adopting_children"] = $data["adopting_children"];
        $values["accept_children_under_18"] = $data["accept_children_under_18"];

        Partner_grew_up_country::where('user_id', $user)->delete();
        if (isset($data['partner_grew_up_country']) && count($data['partner_grew_up_country']) > 0) {
            foreach ($data['partner_grew_up_country'] as $val) {
                Partner_grew_up_country::create(['user_id' => $user, 'country_id' => $val]);
            }
        }
        Partner_job_category::where('user_id', $user)->delete();
        if (isset($data['partner_job_category']) && count($data['partner_job_category']) > 0) {
            foreach ($data['partner_job_category'] as $val) {
                Partner_job_category::create(['user_id' => $user, 'job_category_id' => $val]);
            }
        }
        Partner_living_country::where('user_id', $user)->delete();
        if (isset($data['partner_living_country']) && count($data['partner_living_country']) > 0) {
            foreach ($data['partner_living_country'] as $val) {
                Partner_living_country::create(['user_id' => $user, 'country_id' => $val]);
            }
        }
        Partner_living_state::where('user_id', $user)->delete();
        if (isset($data['partner_living_state']) && count($data['partner_living_state']) > 0) {
            foreach ($data['partner_living_state'] as $val) {
                Partner_living_state::create(['user_id' => $user, 'state_id' => $val]);
            }
        }
        Partner_marital_status::where('user_id', $user)->delete();
        if (isset($data['partner_marital_status']) && count($data['partner_marital_status']) > 0) {
            foreach ($data['partner_marital_status'] as $val) {
                Partner_marital_status::create(['user_id' => $user, 'marital_status_id' => $val]);
            }
        }
        Partner_qualification::where('user_id', $user)->delete();
        if (isset($data['partner_qualification']) && count($data['partner_qualification']) > 0) {
            foreach ($data['partner_qualification'] as $val) {
                Partner_qualification::create(['user_id' => $user, 'qualification_id' => $val]);
            }
        }

        User_profile::where('user_id', $user)->update($values);

        echo json_encode(['response' => 1, 'msg' => 'Profile updated successfully']);
    }

    /*
     * 
     * function hangoutRequestDetailsAction
     * 
     * return hangoutRequestDetailsview
     * param null
     */

    public function hangoutRequestDetailsAction(Request $request, $token) {
        if (isset($token)) {
            $hangId = Core::decodeIdAction($token);
            $message = Hangouts::select('hangouts.*', 'users.name', 'users.profileimage')
                            ->join('users', function($sql) {
                                $sql->on('users.id', 'hangouts.sender_id');
                                $sql->orOn('users.id', 'hangouts.receiver_id');
                            })
                            ->where('hangouts.id', $hangId)
                            ->orderBy('hangouts.id', 'asc')
                            ->first()->toArray();
          

            if ($message['sender_id'] == Auth::user()->id) {
                $user = User::find($message['receiver_id'])->toArray();
            } else {
                $user = User::find($message['sender_id'])->toArray();
            }
            return view('profile::hangout_request')->with(['user' => $user, 'hangout' => $message, 'my' => Auth::user()->id, 'token' => $token]);
        } else {
            return redirect('hangout');
        }
    }

    /*
     * 
     * function hangoutRequestDetailsAction
     * 
     * return hangoutRequestDetailsview
     * param null
     */

    public function dineRequestDetailsAction(Request $request, $token) {
        if (isset($token)) {
            $hangId = Core::decodeIdAction($token);
            $message = Dine::select('dines.*', 'users.name', 'users.profileimage')
                            ->join('users', function($sql) {
                                $sql->on('users.id', 'dines.sender_id');
                                $sql->orOn('users.id', 'dines.receiver_id');
                            })
                            ->where('dines.id', $hangId)
                            ->orderBy('dines.id', 'asc')
                            ->first()->toArray();
            if ($message['sender_id'] == Auth::user()->id) {
                $user = User::find($message['receiver_id'])->toArray();
            } else {
                $user = User::find($message['sender_id'])->toArray();
            }
            return view('profile::dine_request')->with(['user' => $user, 'dine' => $message, 'my' => Auth::user()->id, 'token' => $token]);
        } else {
            return redirect('dine');
        }
    }

    /*
     * 
     * function hangoutStatusAction
     * 
     * return hangoutRequestDetailsview
     * param null
     */

    public function hangoutStatusAction() {

        $hangId = Input::get('hangId');
        $status = Input::get('status');
        if ($status == 'accept') {
            $status = 'accepted';
        } else {
            $status = 'rejected';
        }
        if (!empty($hangId) && !empty($status)) {

            $data = Hangouts::where('id', $hangId)->update(['hangout_status' => $status]);
            if (!empty($data)) {
                return response()->json(['status' => '1']);
            }
        }
    }

    /*
     * 
     * function diningStatusAction
     * 
     * return hangoutRequestDetailsview
     * param null
     */

    public function diningStatusAction() {
        $dineId = Input::get('dineId');
        $status = Input::get('status');
        if ($status == 'accept') {
            $status = 'accepted';
        } else {
            $status = 'rejected';
        }
        if (!empty($dineId) && !empty($status)) {
            $data = Dine::where('id', $dineId)->update(['dine_status' => $status]);
            if (!empty($data)) {
                return response()->json(['status' => '1']);
            }
        }
    }

}
