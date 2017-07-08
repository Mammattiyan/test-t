<?php

namespace App\Modules\Message\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Modules\Message\Models\Messages;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

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
//
        $receiver = Messages::select('messages.*', DB::raw('(SELECT name FROM users wHERE users.id =messages.sender) AS messager_name'),DB::raw('(SELECT profileimage FROM users wHERE users.id =messages.sender) AS profileimage'))
                        ->join('users', 'users.id', 'messages.receiver')
                        ->where('messages.receiver', $useId)
                        ->orderBY('messages.id', 'desc')
                        ->get()->toArray();
        $sender = Messages::select('messages.*',DB::raw('(SELECT name FROM users wHERE users.id =messages.receiver) AS messager_name'),DB::raw('(SELECT profileimage FROM users wHERE users.id =messages.receiver) AS profileimage'))
                        ->join('users', 'users.id', 'messages.sender')
                        ->where('messages.sender', $useId)
                        ->orderBY('messages.id', 'desc')
                        ->get()->toArray();  
        
        dd($receiver,$sender);
        $allMessage = collect(array_merge($receiver, $sender));
        $keyed = $allMessage->sortByDesc('id');
        $final = $keyed->all();
        return view('message::index')->with(['messages'=>$final]);
    }

}
