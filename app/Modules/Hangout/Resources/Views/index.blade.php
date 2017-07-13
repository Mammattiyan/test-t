@extends('layouts.app')
@section('title')
Itweetup :: Message
@endsection
@section('content')
<div class="flex-item updates-block">
    @include('search::search_form')
    <div class="box pad">
        <div class="thick-text">Messages</div>
        @foreach($hangouts as $key =>$value)
        @if($value['receiver_id'])
        <a href="{{ URL::to('profile/hangout').'/'.\App\Modules\Core\Http\Controllers\Core::encodeIdAction($value['receiver_id'])}}" class="activity" style="color: #1e3948">
            @else
            <a href="{{ URL::to('profile/hangout').'/'.\App\Modules\Core\Http\Controllers\Core::encodeIdAction($value['sender_id'])}}" class="activity" style="color: #1e3948">
                @endif
                <img src="{{ URL::to($value['profileimage']) }}" class="user-icon">
                <div class="activity-text">
                    <div class="bold-text">{{ ucfirst($value['name']) }}</div>
                    <div class="activity-details">{!! ''. ucfirst($value['event']).'&nbsp;<span class="text-right">Date:'.$value['date'].'</span>'!!}</div>
                    <div class="timestamp"> {{$value['created_at']}}</div>
                </div>
            </a>
            @endforeach

    </div>
</div>
@endsection