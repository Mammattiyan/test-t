@extends('layouts.app')
@section('title')
Itweetup :: Message
@endsection
@section('content')

<div class="flex-item updates-block">
    @include('search::search_form')
    <div class="box pad list-item">
        <div class="thick-text">Hangout</div>
        @foreach($hangouts as $key =>$value)
        @if($value['receiver_id'])
        <a href="{{ URL::to('profile/hangout').'/'.\App\Modules\Core\Http\Controllers\Core::encodeIdAction($value['id'])}}" class="activity" style="color: #1e3948">
            <?php 
            $requestMsg="has sent a hangout request";
            ?>
            @else
             <?php 
            $requestMsg="you sent a hangout request";
            ?>
            <a href="{{ URL::to('profile/hangout').'/'.\App\Modules\Core\Http\Controllers\Core::encodeIdAction($value['id'])}}" class="activity" style="color: #1e3948">
                @endif
                <img src="{{ URL::to($value['profileimage']) }}" class="user-icon">
                <div class="activity-text">
                    <div class="bold-text">{{ ucfirst($value['name']) }}</div>
                    <div class="activity-details">{{ $requestMsg }} <span class="text-right">{!! '<strong>'. ucfirst($value['event']).'</strong>&nbsp;:'.$value['date'].'</span>'!!}</div>
                    <div class="timestamp"> {{$value['created_at']}}<span class="text-right">Request {{ ucfirst($value['hangout_status'])}}</span></div>
                </div>
            </a>
            @endforeach

    </div>
</div>
@endsection