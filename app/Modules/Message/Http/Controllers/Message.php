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
        $useId = Auth::User()->id;
        $messages = Messages::select('messages.*', DB::raw('(SELECT name FROM users wHERE users.id =messages.receiver and users.id <> '.$useId.' ) AS messager_receiver'), DB::raw('(SELECT name FROM users wHERE users.id =messages.sender and users.id <> '.$useId.' ) AS messager_sender'),
                 DB::raw('(SELECT id FROM users wHERE users.id =messages.receiver and users.id <> '.$useId.' ) AS receiver_id'), DB::raw('(SELECT id FROM users wHERE users.id =messages.sender and users.id <> '.$useId.' ) AS sender_id'), 
                DB::raw('(SELECT profileimage FROM users wHERE users.id =messages.receiver and users.id <> '.$useId.' ) AS receiver_profileimage'), DB::raw('(SELECT profileimage FROM users wHERE users.id =messages.sender and users.id <> '.$useId.' ) AS sender_profileimage'))
                ->join('users', function($sql) {
                    $sql->on('users.id', 'messages.sender');
                    $sql->orOn('users.id', 'messages.receiver');
                })
                ->where('messages.last_status', 1)
                ->distinct()
                ->orderBY('messages.id', 'desc')->get()->toArray();
        return view('message::index')->with(['messages' => $messages]);
    }

}
