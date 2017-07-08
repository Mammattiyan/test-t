@extends('layouts.app')
@section('title')
	Itweetup :: Activities
@endsection
@section('content')
<div class="flex-item updates-block">
    <div class="box">
        <div class="pad">
            <div class="search-field">
                <input type="text" name="search-stuff" placeholder="Search">
                <a href="#"></a>
            </div>
        </div>
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
        <div class="thick-text">Recent Activity</div>
        <div class="activity">
            <img src="../assets/user2.jpg" class="user-icon">
            <div class="activity-text">
                <div class="bold-text">Shay Laren</div>
                <div class="activity-details">has sent a date request</div>
                <div class="timestamp">11:32 PM</div>
            </div>
        </div>
        <div class="activity">
            <img src="../assets/user3.jpg" class="user-icon">
            <div class="activity-text">
                <div class="bold-text">Shay Laren</div>
                <div class="activity-details">has sent a hangout request</div>
                <div class="timestamp">10:24 PM</div>
            </div>
        </div>
        <div class="activity">
            <img src="../assets/user4.jpg" class="user-icon">
            <div class="activity-text">
                <div class="activity-details">You have sent a hangout request to</div>
                <div class="bold-text">Veronica Zamenova</div>
                <div class="timestamp">08:32 AM</div>
            </div>
        </div>
        <div class="activity">
            <img src="../assets/user2.jpg" class="user-icon">
            <div class="activity-text">
                <div class="bold-text">Shay Laren</div>
                <div class="activity-details">has sent a date request</div>
                <div class="timestamp">11:14 PM</div>
            </div>
        </div>
        <div class="activity">
            <img src="../assets/user1.jpg" class="user-icon">
            <div class="activity-text">
                <div class="activity-details">You updated your profile data</div>
                <div class="timestamp">02:45 PM</div>
            </div>
        </div>
    </div>
</div>
@endsection