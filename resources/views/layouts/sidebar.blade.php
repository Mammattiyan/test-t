<div class="flex-item userdata-block">
    <div class="box userinfo-tile">
        <div id="cropContainerModal"  class="user-photo" style="height:270px;width: 100%;background-image: url('{{ URL::to(Auth::user()->profileimage) }}') "></div>

        <div class="pad">
            <div class="thick-text">{{ ucfirst(Auth::user()->name )}} </div>
            <div class="user-motto">Live and let live</div>

            <div class="thick-text">Profile Completion</div>
            <div class="progress-bar">
                <div class="perc-text">70%</div>
                <div class="perc-bar"></div>
            </div>
            <br>
            <a href="#">Verify Profile</a>

        </div>
    </div>
    <div class="box pad nav-tile">
        <div class="thick-text">Links</div>
        <ul class="nav-links">
            <li class="nav nav-activity"><a href="{{ URL::to('activity')}}">Activity</a></li>
            <li class="nav nav-message"><a href="{{ URL::to('message')}}">Message</a></li>
            <li class="nav nav-hangout"><a href="{{ URL::to('hangout')}}">Hangout</a></li>
            <li class="nav nav-chat"><a href="#">Chat</a></li>
            <li class="nav nav-matches"><a href="#">Matches</a></li>
            <li class="nav nav-date-alert"><a href="#">Date Alert</a></li>
            <li class="nav nav-dining"><a href="{{ URL::to('dine')}}">Dining</a></li>
            <li class="nav nav-upload-photo"><a href="{{ URL::to('photos')}}">Photos</a></li>
            <li class="nav nav-upload-video"><a href="{{ URL::to('videos')}}">Videos</a></li>
        </ul>
    </div>
</div>