
@extends('profile::app')
@section('title')
Itweetup :: Activities
@endsection
@section('content')
<?php // dd($user); ?>
<div class="main-section">
    <div class="container flex-box fd-col fd-lg-row equisized-lg-items">
        @include('profile::profile_side')
        <div class="flex-item updates-block">
            @include('search::search_form')
            <div class="box pad">
                <div class="thick-text">About Me</div>
                <span class="user-info">Name: {{ucfirst($fullData['full_name'])}}</span><br>
                <span class="user-info">Age: 28</span><br>
                <span class="user-info">Height: {{$fullData['height']}}</span><br>
                <span class="user-info">Gender preference: {{$fullData['gender_preference_name']}}</span><br>
                <span class="user-info">Ethnic origin: {{$fullData['ethnic_origin_name']}}</span><br>
                <span class="user-info">Qualification: {{$fullData['qualification_name']}}</span><br>
                <span class="user-info">Job Category: {{$fullData['category_name']}}</span><br>
                <span class="user-info">Smokeing Status: {{$fullData['smoke_status']}}</span><br>
                <span class="user-info">Drink Status: {{$fullData['drink_status']}}</span><br>
                <span class="user-info">Pet lover: {{$fullData['pet_lover']}}</span><br>
                <span class="user-info">Relationship story: {{$fullData['marital_status']}}</span><br>
                <span class="user-info">Location: {{$fullData['location']}}</span><br><br>
                <span class="user-info"> Zodiac name: {{$fullData['zodiac_name']}}</span><br><br>
                <?php $url = asset("images/zodiac-signs/" . $fullData['sign_image_url']); ?>
                <span class="user-info">Zodiac sign: <img style=" width: 89px;" src=<?php echo $url ?>></span><br><br>
                <span>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.<br><br> Enim ad minim veniam, quis nostrud exercitation love.</span>
            </div>
            <div class="box pad photo-gallery">
                <div class="thick-text">Photos</div>
                @if(count($gallery['images'])>0)
                @foreach($gallery['images'] as $key => $value)
                @if($key == 0)
                <img src="{{ asset($value['path'])}}" class="featured-photo" data-pv="1">
                @else
                <img src="{{ asset($value['path'])}}" data-pv="2">
                @endif
                @endforeach
                @else
                <div class="vg-item-wrap">
                    <div class="vg-item">
                        Not Upload images
                    </div>
                </div>
                @endif
            </div>
            <div class="box pad video-gallery">
                <div class="thick-text">Videos</div>

                @if(count($gallery['videos'])>0)
                @foreach($gallery['videos'] as $key => $value)
                @if($key == 0)
                <div class="vg-item-wrap featured-vg-item">
                    <div class="vg-item">
                        <!--<iframe width="560" height="315" src="{{asset($value['path'])}}" frameborder="0" allowfullscreen="1" class="video"></iframe>-->

                        <video width="560" height="315" controls>
                            <source src="{{asset($value['path'])}}" type="video/mp4">
                            <source src="{{asset($value['path'])}}" type="video/ogg">

                        </video>
                    </div>
                </div>
                @else
                <div class="vg-item-wrap">
                    <div class="vg-item">
                        <!--<iframe width="560" height="315" src="{{asset($value['path'])}}" frameborder="0" allowfullscreen="1" class="video"></iframe>-->

                        <video width="560" height="315" controls>
                            <source src="{{asset($value['path'])}}" type="video/mp4">
                            <source src="{{asset($value['path'])}}" type="video/ogg">

                        </video>
                    </div>
                </div>
                @endif
                @endforeach
                @else
                <div class="vg-item-wrap">
                    <div class="vg-item">
                        Not Upload videos
                    </div>
                </div>
                @endif
            </div>
        </div>
        @include('profile::right_side')
    </div>
</div>
<div class="modal-glass hide">
    <div class="modal show-modal">
        <div class="modal-heading"></div>
        <div class="modal-body"></div>
        <div class="modal-close"></div>
        <div class="pv-control prev"></div>
        <div class="pv-control next"></div>
    </div>
</div>
<div class="hide" data-modal-contents-wrap>
    <div data-modal-content="hangoutSent">
        <div data-modal-heading>Send Hangout Request</div>
        <div data-modal-body>

            {{ Form::open(array('url' => 'hangout/sent'.'/'.$token)) }}
            <div class="accordion-group">
                <div class="accordion">
                    <div class="row">
                        <label>Event <span class="text text-danger">*</span></label>
                        <input type="text" name="event" value="{{ $data['event']  or "" }}" required >                        
                    </div>
                    <div class="row">
                        <label>Location <span class="text text-danger">*</span></label>
                        <input type="text" name="location" value="{{ $data['location']  or "" }}" required >                      
                    </div>

                    <div class="row">
                        <label>Date <span class="text text-danger">*</span></label>
                        <input type="text" name="date"  value="{{ $data['date']  or "" }}" id="hangoutDate" required >
                    </div>
                    <div class="row">
                        <label>Time <span class="text text-danger">*</span></label>
                        <input type="text" name="time" value="{{ $data['time']  or "" }}" id="hangoutTime" required>
                    </div>
                    <div class="row">
                        <label>Private <span class="text text-danger">*</span></label>
                        <div class="radioRow"><input type="radio" name="private_hangout" value="yes" checked><label>Yes</label>
                            <input type="radio" name="private_hangout" value="no"><label>No</label>
                        </div> 
                    </div>
                    <div class="row">
                        <label>Accompany <span class="text text-danger">*</span></label>
                        <div class="radioRow"><input type="radio" name="accompany_hangout" value="yes" checked><label>Yes</label>
                            <input type="radio" name="accompany_hangout" value="no"><label>No</label>
                        </div> 
                    </div>
                    <div class="formRow">
                        <label>Family Member <span class="text text-danger">*</span></label>
                        <div class="radioRow">{!! Form::select('family_member[]', $user['family_members'], [], ['class' => 'dropdown', 'required','id'=>'family_member','multiple'=>'multiple']) !!}</div> 
                    </div>


                    <div class="flex-item text-right">
                        <input type="submit" name="submit" class="button" value="Submit">
                    </div>
                    {{ Form::close() }}
                </div>
            </div>

        </div>
    </div>
</div>
<div class="hide" data-modal-contents-wrap>
    <div data-modal-content="dineSent">
        <div data-modal-heading>Send Dine Request</div>
        <div data-modal-body>

            {{ Form::open(array('url' => 'dine/sent'.'/'.$token)) }}
            <div class="accordion-group">
                <div class="accordion">
                    <div class="row">
                        <label>Event <span class="text text-danger">*</span></label>
                        <input type="text" name="event" value="" required >                        
                    </div>
                    <div class="row">
                        <label>Location <span class="text text-danger">*</span></label>
                        <input type="text" name="location" value="" required >                      
                    </div>

                    <div class="row">
                        <label>Date <span class="text text-danger">*</span></label>
                        <input type="text" name="date"  value="" id="dineDate" required >
                    </div>
                    <div class="row">
                        <label>Time <span class="text text-danger">*</span></label>
                        <input type="text" name="time" value="" id="dineTime" required>
                    </div>
                    <div class="row">
                        <label>Private <span class="text text-danger">*</span></label>
                        <input type="text" name="private" value="" required>
                    </div>
                    <div class="row">
                        <label>Accompany <span class="text text-danger">*</span></label>
                        <input type="text" name="accompany" value="" required >
                    </div>
                    <div class="row">
                        <label>Family Member <span class="text text-danger">*</span></label>
                        <input type="text" name="family_member" value="{{ $data['family_member']  or "" }}" required>
                    </div>
                    <div class="flex-item text-right">
                        <input type="submit" name="submit" class="button" value="Submit">
                    </div>
                    {{ Form::close() }}
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
@section('js')




@endsection