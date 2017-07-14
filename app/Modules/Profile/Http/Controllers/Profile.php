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
use App\Modules\Hangout\Models\Hangouts;
use App\Modules\Message\Models\Dine;

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
            return view('profile::user_messages')->with(['user' => $user, 'message' => $message, 'my' => Auth::user()->id]);
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
            list($width, $height) = getimagesize(public_path($destinationPath . '/' . $fileName));
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
        $outputFilename = public_path($fileName);
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
            return view('profile::hangout_request')->with(['user' => $user, 'hangout' => $message, 'my' => Auth::user()->id]);
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
            return view('profile::dine_request')->with(['user' => $user, 'dine' => $message, 'my' => Auth::user()->id]);
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
            $status = 'accepted';
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
