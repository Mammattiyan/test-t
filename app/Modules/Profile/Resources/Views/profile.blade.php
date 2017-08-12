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
            <div class="thick-text">Notifications</div>
            <div class="notifications-wrap">
                <div class="notification">
                    <div class="noti-count">{{$data['messageCount']}}</div>
                    <div class="noti-name">Message</div>
                </div>
                <div class="notification">
                    <div class="noti-count">345</div>
                    <div class="noti-name">Notification</div>
                </div>
                <div class="notification">
                    <div class="noti-count">{{$data['dineCount']}}</div>
                    <div class="noti-name">Dining</div>
                </div>
                <div class="notification">
                    <div class="noti-count">{{$data['hangoutCount']}}</div>
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
        <div class="thick-text">Recent Activity</div>
        @if(count($recentData) > 0)
        @foreach($recentData as $key =>$value)
        @if($value['user_id']==$userId)
        <div class="activity">
            <img src="{{ asset($value['receiver_profile_pic'])}}" class="user-icon">
            <div class="activity-text">
                <div class="bold-text">{{$value['receiver_name']}}</div>
                <div class="activity-details">{{$value['display_message']}}</div>
                <div class="timestamp">{{$value['created_at']}}</div>
            </div>
        </div>
        
        @else
         <div class="activity">
            <img src="{{ asset($value['receiver_profile_pic'])}}" class="user-icon">
            <div class="activity-text">
                <div class="bold-text">{{$value['receiver_name']}}</div>
                <div class="activity-details">You receive {{$value['module_name']}} request</div>
                <div class="timestamp">{{$value['created_at']}}</div>
            </div>
        </div>      
        @endif
        
        @endforeach
        @else
        <div class="activity">
          
            <div class="activity-text">
                <div class="bold-text">No Recent Activity Found</div>
               
            </div>
        </div> 
        
        @endif
        
<!--        <div class="activity">
            <img src="{{ asset('assets/user3.jpg')}}" class="user-icon">
            <div class="activity-text">
                <div class="bold-text">Shay Laren</div>
                <div class="activity-details">has sent a hangout request</div>
                <div class="timestamp">10:24 PM</div>
            </div>
        </div>
        <div class="activity">
            <img src="{{ asset('assets/user4.jpg')}}" class="user-icon">
            <div class="activity-text">
                <div class="activity-details">You have sent a hangout request to</div>
                <div class="bold-text">Veronica Zamenova</div>
                <div class="timestamp">08:32 AM</div>
            </div>
        </div>
        <div class="activity">
            <img src="{{ asset('assets/user2.jpg')}}" class="user-icon">
            <div class="activity-text">
                <div class="bold-text">Shay Laren</div>
                <div class="activity-details">has sent a date request</div>
                <div class="timestamp">11:14 PM</div>
            </div>
        </div>
        <div class="activity">
            <img src="{{ asset('assets/user1.jpg')}}" class="user-icon">
            <div class="activity-text">
                <div class="activity-details">You updated your profile data</div>
                <div class="timestamp">02:45 PM</div>
            </div>
        </div>-->
    </div>
</div>

<div class="hide" data-modal-contents-wrap>
            <div data-modal-content="trusted">
                <div data-modal-heading>Trusted</div>
                <div data-modal-body>
                   <div class="thick-text"></div>Itweetup verifies users credibility based on the documents user/member provide us and its matched and checked with external document verification service providers and users on the itweetup; who has CV highlighted on their profiles are the members who have verified their Citizenship with itweetup and this makes them more authentic/true members. <br><br>
                </div>
            </div>
        </div>
@endsection