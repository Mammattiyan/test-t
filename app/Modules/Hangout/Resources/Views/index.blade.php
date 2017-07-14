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


            @if($value['sender_id']==Auth::user()->id)
            @if($value['hangout_status']=='sent')
            <?php
            $requestMsg = 'You sent a hangout request';
            $requestStatus = 'Request Sent';
            ?>

            @elseif($value['hangout_status']=='rejected')
            <?php
            $requestMsg = 'has rejected your hangout request';
            $requestStatus = 'Request Rejected';
            ?>            
            @elseif($value['hangout_status']=='accepted')
            <?php
            $requestMsg = 'has accepted a hangout request';
            $requestStatus = 'Request Accepted';
            ?>
            @else
            <?php
            $requestMsg = 'You sent a hangout request';
            $requestStatus = 'Request Sent';
            ?>          
            @endif
            @else
            @if($value['hangout_status']=='requested')
            <?php
            $requestMsg = 'Has sent a hangout request';
            $requestStatus = 'Request Sent';
            ?>
            @elseif($value['hangout_status']=='rejected')
            <?php
            $requestMsg = 'You rejected his hangout request';
            $requestStatus = 'Request Rejected';
            ?>            
            @elseif($value['hangout_status']=='accepted')
            <?php
            $requestMsg = 'You accepted a hangout request';
            $requestStatus = 'Request Accepted';
            ?>
            @else
            <?php
            $requestMsg = 'Has sent a hangout request';
            $requestStatus = 'Request Sent';
            ?>          
            @endif
            @endif
            <a href="{{ URL::to('profile/hangout').'/'.\App\Modules\Core\Http\Controllers\Core::encodeIdAction($value['id'])}}" class="activity" style="color: #1e3948">
                @endif
                <img src="{{ URL::to($value['profileimage']) }}" class="user-icon">
                <div class="activity-text">
                    <div class="bold-text">{{ ucfirst($value['name']) }}</div>
                    <div class="activity-details">{{ $requestMsg }} <span class="text-right">{!! '<strong>'. ucfirst($value['event']).'</strong>&nbsp;:'.$value['date'].'</span>'!!}</div>
                    <div class="timestamp"> {{$value['created_at']}}<span class="text-right"> {{ ucfirst($requestStatus)}}</span></div>
                </div>
            </a>
            @endforeach

    </div>
</div>
@endsection