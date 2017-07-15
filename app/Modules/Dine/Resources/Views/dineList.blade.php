@extends('layouts.app')
@section('title')
Itweetup :: Message
@endsection
@section('content')

<div class="flex-item updates-block">
    @include('search::search_form')
    <div class="box pad list-item">
        <div class="thick-text">Dining</div>
        @foreach($dines as $key =>$value)
        @if($value['receiver_id'])
        <a href="{{ URL::to('profile/dine').'/'.\App\Modules\Core\Http\Controllers\Core::encodeIdAction($value['id'])}}" class="activity" style="color: #1e3948">
            @if($value['sender_id']==Auth::user()->id)
            @if($value['dine_status']=='sent')
            <?php
            $requestMsg = 'You sent a dining request';
            $requestStatus = 'Request Sent';
            ?>

            @elseif($value['dine_status']=='rejected')
            <?php
            $requestMsg = 'has rejected your dining request';
            $requestStatus = 'Request Rejected';
            ?>            
            @elseif($value['dine_status']=='accepted')
            <?php
            $requestMsg = 'has accepted a dining request';
            $requestStatus = 'Request Accepted';
            ?>
            @else
            <?php
            $requestMsg = 'You sent a dining request';
            $requestStatus = 'Request Sent';
            ?>          
            @endif
            @else
            @if($value['dine_status']=='requested')
            <?php
            $requestMsg = 'Has sent a dining request';
            $requestStatus = 'Request Sent';
            ?>
            @elseif($value['dine_status']=='rejected')
            <?php
            $requestMsg = 'You rejected his dining request';
            $requestStatus = 'Request Rejected';
            ?>            
            @elseif($value['dine_status']=='accepted')
            <?php
            $requestMsg = 'You accepted a dining request';
            $requestStatus = 'Request Accepted';
            ?>
            @else
            <?php
            $requestMsg = 'Has sent a dining request';
            $requestStatus = 'Request Sent';
            ?>          
            @endif
            @endif
            <a href="{{ URL::to('profile/dine').'/'.\App\Modules\Core\Http\Controllers\Core::encodeIdAction($value['id'])}}" class="activity" style="color: #1e3948">
                @endif
                <img src="{{ URL::to($value['profileimage']) }}" class="user-icon">
                <div class="activity-text">
                    <div class="bold-text">{{ ucfirst($value['name']) }}</div>
                    <div class="activity-details">{{ $requestMsg }} <span class="text-right">{!! '<strong>'. ucfirst($value['event']).'</strong>&nbsp;:'.$value['date'].'</span>'!!}</div>
                    <div class="timestamp"> {{$value['created_at']}}<span class="text-right"> {{ $requestStatus }}</span></div>
                </div>
            </a>
            @endforeach

    </div>
</div>
@endsection