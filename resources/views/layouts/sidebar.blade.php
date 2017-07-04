<div class="flex-item userdata-block">
    <div class="box userinfo-tile">
        <img src="{{ asset('assets/user1.jpg')}}" class="user-photo">
        <div class="pad">
            <div class="thick-text">{{ ucfirst(Auth::user()->name )}}</div>
            <div class="user-motto">Live and let live</div>
            <br>
            <a href="#">Verify Profile</a>
        </div>
    </div>
    <div class="box pad nav-tile">
        <div class="thick-text">Links</div>
        <ul class="nav-links">
            <li class="nav nav-activity"><a href="{{ URL::to('activity')}}">Activity</a></li>
            <li class="nav nav-message"><a href="{{ URL::to('message')}}">Message</a></li>
            <li class="nav nav-hangout"><a href="#">Hangout</a></li>
            <li class="nav nav-chat"><a href="#">Chat</a></li>
            <li class="nav nav-matches"><a href="#">Matches</a></li>
            <li class="nav nav-date-alert"><a href="#">Date Alert</a></li>
            <li class="nav nav-dining"><a href="#">Dining</a></li>
            <li class="nav nav-upload-photo"><a href="#">Photos</a></li>
            <li class="nav nav-upload-video"><a href="#">Videos</a></li>
        </ul>
    </div>
</div>