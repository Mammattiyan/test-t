<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Feedbacks;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('home');
    }

    /**
     * function sendFeedbackAction
     *
     * @param post data
     * @return view
     */
    public function sendFeedbackAction() {
        $data = array(
            'full_name' => strip_tags(input::get('full_name')),
            'email' => strip_tags(input::get('email')),
            'web' => strip_tags(input::get('web')),
            'feedback' => input::get('feedback')
        );
        $validator = Validator::make($data, [
                    'full_name' => 'required|max:255',
                    'email' => 'required:email|max:255',
                    'web' => 'required|max:255',
                    'feedback' => 'required'
        ]);
        if ($validator->fails()) {
            foreach (array_values($validator->messages()->toArray()) as $msg) {
                $error = implode(' ', $msg) . '<br>';
            }
            return view('welcome')->with(['errors' => $validator->errors()->all()]);
        } else {
            Feedbacks::create($data);
            return view('welcome')->with(['feedback_status' => '1']);
        }
    }

}
