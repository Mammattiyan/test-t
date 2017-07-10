@extends('layouts.app')
@section('title')
Itweetup :: Message
@endsection
@section('content')
<div class="flex-item updates-block">
    @include('search::search_form')
    <div class="box pad">
        <div class="thick-text">Messages</div>
        @foreach($messages as $key =>$value)
        @if($value['receiver_id'])
        <a href="{{ URL::to('profile/message').'/'.\App\Modules\Core\Http\Controllers\Core::encodeIdAction($value['receiver_id'])}}" class="activity" style="color: #1e3948">
            @else
            <a href="{{ URL::to('profile/message').'/'.\App\Modules\Core\Http\Controllers\Core::encodeIdAction($value['sender_id'])}}" class="activity" style="color: #1e3948">
                @endif
                <img src="{{ $value['receiver_profileimage'] or $value['sender_profileimage']}}" class="user-icon">
                <div class="activity-text">
                    <div class="bold-text">{{ $value['messager_receiver'] or  $value['messager_sender']}}</div>
                    <div class="activity-details">{{$value['message']}}</div>
                    <div class="timestamp"> {{$value['created_at']}}</div>
                </div>
            </a>
            @endforeach

    </div>
</div>
@endsection