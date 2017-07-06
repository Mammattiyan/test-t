@extends('layouts.app')
@section('title')
Itweetup :: Activities
@endsection
@section('content')
<div class="flex-item updates-block">
    <div class="box">
        @include('search::search_form')
        <hr>
        <div class="pad">
            <div class="thick-text">Profile Completion</div>
            <div class="progress-bar">
                <div class="perc-text">70%</div>
                <div class="perc-bar"></div>
            </div>
        </div>
        <hr>
        <div class="pad">
            <div class="thick-text">Notifications</div>
            <div class="notifications-wrap">
                <div class="notification">
                    <div class="noti-count">37</div>
                    <div class="noti-name">Message</div>
                </div>
                <div class="notification">
                    <div class="noti-count">345</div>
                    <div class="noti-name">Notification</div>
                </div>
                <div class="notification">
                    <div class="noti-count">12</div>
                    <div class="noti-name">Dining</div>
                </div>
                <div class="notification">
                    <div class="noti-count">127</div>
                    <div class="noti-name">Hangout</div>
                </div>
                <div class="notification">
                    <div class="noti-count">15</div>
                    <div class="noti-name">Activity</div>
                </div>
            </div>
        </div>
    </div>
    <div class="box pad">
        <div class="thick-text">Search Result</div>
        @if(!empty($result))
        @foreach($result as $val)
        <div class="activity">
            <img src="../assets/user2.jpg" class="user-icon">
            <div class="activity-text">
                <div class="bold-text"> <a href="{{ url('/logout') }}"  onclick="event.preventDefault();document.getElementById('user_profile').submit();">{{$val->name}}</a></div>                
                {!! Form::open(array('url'=>'profile/user','id'=>'user_profile','method'=>'post')) !!} 
                {{ Form::hidden("user_id",$val->id)}}
                {!! Form::close() !!}
                <!--                <div class="activity-details">has sent a date request</div>
                                <div class="timestamp">11:32 PM</div>-->
            </div>
        </div>
        @endforeach
        @endif
    </div>
</div>
@endsection