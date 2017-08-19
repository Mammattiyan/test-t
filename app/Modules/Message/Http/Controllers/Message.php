<?php

namespace App\Modules\Message\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Modules\Message\Models\Messages;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use App\User;


class Message extends Controller {
    /*
     * 
     * function indexAction
     * 
     * return message list view
     * param null
     */

    public function indexAction() {
        $userId = Auth::User()->id;        
//        $messages = Messages::select('messages.*', DB::raw('(SELECT name FROM users wHERE users.id =messages.receiver and users.id <> '.$userId.' ) AS messager_receiver'), DB::raw('(SELECT name FROM users wHERE users.id =messages.sender and users.id <> '.$userId.' ) AS messager_sender'),
//                 DB::raw('(SELECT id FROM users wHERE users.id =messages.receiver and users.id <> '.$userId.' ) AS receiver_id'), DB::raw('(SELECT id FROM users wHERE users.id =messages.sender and users.id <> '.$userId.' ) AS sender_id'), 
//                DB::raw('(SELECT profileimage FROM users wHERE users.id =messages.receiver and users.id <> '.$userId.' ) AS receiver_profileimage'), DB::raw('(SELECT profileimage FROM users wHERE users.id =messages.sender and users.id <> '.$userId.' ) AS sender_profileimage'))
//                ->join('users', function($sql) {
//                    $sql->on('users.id', 'messages.sender');
//                    $sql->orOn('users.id', 'messages.receiver');
//                })
//                ->where('messages.last_status', 1)
//                ->distinct()
//                ->orderBY('messages.id', 'desc')->get()->toArray();
                
        $messages = Messages::select(DB::raw('MAX(messages.id) max_id'), DB::raw('IF(messages.sender='.$userId.',messages.receiver,messages.sender) as user_id'))
                ->with(['message_details' => function($sql){
                    $sql->select();
                }])
                ->with(['user_details' => function($sql){
                    $sql->select();
                }])
                ->groupBy('messages.sender', 'messages.receiver')
                ->where(function($sql) use ($userId){
                    $sql->where(['messages.sender' => $userId]);
                    $sql->orWhere(['messages.receiver' => $userId]);
                })
                ->get()->toArray();
//        dd($message);
        return view('message::index')->with(['messages' => $messages]);
    }

}
