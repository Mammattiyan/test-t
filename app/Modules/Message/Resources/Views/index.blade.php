@extends('layouts.app')
@section('title')
Itweetup :: Message
@endsection
@section('content')
<div class="flex-item updates-block">
    @include('search::search_form')
    <div class="box pad">
        <div class="thick-text">Messages</div>
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