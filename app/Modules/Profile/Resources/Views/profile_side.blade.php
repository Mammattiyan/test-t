<div class="flex-item userdata-block">
    <div class="box userinfo-tile">
        <img src="{{asset($fullData['profileimage'])}}" class="user-photo">
        <div class="pad">
            <div class="thick-text">{{ ucfirst($fullData['full_name'])}}</div>
            <div class="user-motto">Real beauty is always inside</div>
        </div>
    </div>
    <div class="box pad nav-tile">
        <div class="thick-text">Links</div>
        <ul class="nav-links">
            <li class="nav nav-activity"><a href="{{ URL::to('profile/user').'/'.$token}}">Profile</a></li>
            <li class="nav nav-message"><a href="{{ URL::to('profile/message').'/'.$token}}">Message</a></li>
            <!--<li class="nav nav-hangout"><a href="{{URL::to('hangout').'/'.$token}}">Hangout</a></li>-->
            <li class="nav nav-hangout"><a href='#' data-modal="hangoutSent" data-class="imageBg dating" data-smallwidth="small-modal">Hangout</a></li>
            <li class="nav nav-chat"><a href="#">Chat</a></li>
            <!--<li class="nav nav-dining"><a href="{{URL::to('dine').'/'.$token}}">Dine</a></li>-->
            <li class="nav nav-hangout"><a href='#' data-modal="dinningSent" data-class="imageBg dinner" data-smallwidth="small-modal">Dine</a></li>

        </ul>
    </div>
</div>




