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
        @if($value['user_id'])
        <a href="{{ URL::to('profile/message').'/'.\App\Modules\Core\Http\Controllers\Core::encodeIdAction($value['user_id'])}}" class="activity" style="color: #1e3948">
            @else
            <a href="{{ URL::to('profile/message').'/'.\App\Modules\Core\Http\Controllers\Core::encodeIdAction($value['user_id'])}}" class="activity" style="color: #1e3948">
                @endif
                <img src="{{asset('')}}/{{ $value['user_details']['profileimage'] }}" class="user-icon">
                <div class="activity-text">
                    <div class="bold-text">{{ ucfirst($value['user_details']['name']) }}</div>
                    <div class="activity-details">{{$value['message_details']['message']}}</div>
                    <div class="timestamp"><i>{{$value['message_details']['created_at']}}</i></div>
                </div>
            </a>
            @endforeach

    </div>
</div>
@endsection