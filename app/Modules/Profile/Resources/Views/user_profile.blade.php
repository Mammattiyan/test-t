
@extends('profile::app')
@section('title')
Itweetup :: Profile
@endsection
@section('content')
<?php // dd($user); ?>
<div class="main-section">
    <div class="container flex-box fd-col fd-lg-row equisized-lg-items">
        @include('profile::profile_side')
        <div class="flex-item updates-block">
            @include('search::search_form')

            <div class="box pad personalInfo">
                <div class="thick-text">About Me</div>
                <span class="user-info"><strong>Name:</strong> <i>{{ucfirst($fullData['full_name'])}}</i></span><br>
                <span class="user-info"><strong>Age:</strong> <i>28</i></span><br>
                <span class="user-info"><strong>Height:</strong> <i> {{$fullData['height']}}</i></span><br>
                <span class="user-info"><strong>Gender preference:</strong> <i> {{$fullData['gender_preference_name']}}</i></span><br>
                <span class="user-info"><strong>Ethnic origin:</strong> <i>{{$fullData['ethnic_origin_name']}}</i></span><br>
                <span class="user-info"><strong>Qualification: </strong> <i>{{$fullData['qualification_name']}}</i></span><br>
                <span class="user-info"><strong>Job Category: </strong> <i>{{$fullData['category_name']}}</i></span><br>
                <span class="user-info"><strong>Smokeing Status: </strong> <i>{{$fullData['smoke_status']}}</i></span><br>
                <span class="user-info"><strong>Drink Status: </strong> <i>{{$fullData['drink_status']}}</i></span><br>
                <span class="user-info"><strong>Pet lover: </strong> <i>{{$fullData['pet_lover']}}</i></span><br>
                <span class="user-info"><strong>Relationship story: </strong> <i>{{$fullData['marital_status']}}</i></span><br>
                <span class="user-info"><strong>Location: </strong> <i>{{$fullData['location']}}</i></span><br><br>
                <span class="user-info"><strong> Zodiac name: </strong> <i>{{$fullData['zodiac_name']}}</i></span><br><br>
                <?php
                $url = asset("images/zodiac-signs/" . $fullData['sign_image_url']);

                if ($fullData['sign_image_url'] != "" && $fullData['sign_image_url'] != null) {
                    ?>
                    <span class="user-info">Zodiac sign: <img style=" width: 89px;" src=<?php echo $url ?>></span><br><br>
                    <?php
                }
                ?>
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
<div class="hide" data-modal-contents-wrap >
    <div data-modal-content="hangoutSent">
        <div data-modal-heading>Send Hangout Request</div>
        <div data-modal-body class="imageBg dinner">

            {{ Form::open(array('id'=>'hangoutForm')) }}
            <div class="accordion-group">
                <div class="col col-lg-6 col-md-offset-3">
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
                    <div class="row padding-class">
                        <label>Private </label>
                        <input type="radio" name="private_accompany" value="private" required>
                        <label>Accompany </label>
                        <input type="radio" name="private_accompany" value="accompany" required >
                    </div> 
                    <div class="">
                        <label>Family Member <span class="text text-danger">*</span></label>
                        <div class="radioRow">{!! Form::select('family_member[]',['mother'=>'Mother','father'=>'Father','sister'=>'sister','brother'=>'Brother'], null, ['class' => 'dropdown family_member_dropdown', 'id'=>'hangout_family_member_dropdown', 'required','multiple']) !!}</div> 
                    </div>


                    <div class="flex-item text-right">
                        <input type="button" name="submit" onclick="sendHangout()" class="button" value="Submit">
                    </div>
                </div>
                {{ Form::close() }}
            </div>

        </div>
    </div>

    <div class="hide" data-modal-contents-wrap>
        <div data-modal-content="dinningSent">
            <div data-modal-heading>Send Dine Request</div>
            <div data-modal-body>

                {{ Form::open(array('id'=>'dinningForm')) }}
                <div class="accordion-group">
                    <div class="col col-md-6 col-md-offset-3">
                        <div class="row">
                            <!--$token-->
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
                        <div class="row padding-class" >
                            <label>Private </label>
                            <input type="radio" name="private_accompany" value="private" required>
                            <label>Accompany </label>
                            <input type="radio" name="private_accompany" value="accompany" required >
                        </div>                        
                        <div class="row">
                            <label>Family Member <span class="text text-danger">*</span></label>
                            <div class="radioRow">{!! Form::select('family_member[]',['mother'=>'Mother','father'=>'Father','sister'=>'sister','brother'=>'Brother'], null, ['class' => 'dropdown family_member_dropdown', 'id'=>'dinning_family_member_dropdown','required','multiple']) !!}</div> 
                        </div>
                        <div class="flex-item text-right">
                            <input type="button" name="submit" id="dinningButton" onclick="sendDinning()" class="button" value="Submit">
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
<script>


    function sendDinning() {
        $('#dinningForm').parsley().validate();
        if ($('#dinningForm').parsley().isValid()) {
            $.ajax({
                url: "{{URL::to('dine/sent').'/'.$token}}",
                type: "POST",
                dataType: "json",
                data: $('#dinningForm').serialize(),
                success: function (data) {
                    closeModal()
                    if (data.status = 1) {
                        $.notify({message: "Dinning request send successfully"}, {type: 'success'});
                    } else {
                        $.notify({message: data.msg}, {type: 'danger'});
                    }
                }, error: function () {
                    closeModal();
                }
            });
        }
    }
    function sendHangout() {
        $('#hangoutForm').parsley().validate();
        if ($('#hangoutForm').parsley().isValid()) {
            $.ajax({
                url: "{{URL::to('hangout/sent').'/'.$token}}",
                type: "POST",
                dataType: "json",
                data: $('#hangoutForm').serialize(),
                success: function (data) {
                    closeModal()
                    if (data.status = 1) {
                        $.notify({message: "Hanghout request send successfully"}, {type: 'success'});
                    } else {
                        $.notify({message: data.msg}, {type: 'danger'});
                    }
                }, error: function () {
                    closeModal();
                }
            });
        }
    }
    function closeModal() {
        $('.modal-glass').addClass('hide').find('.modal').removeClass('show-modal').children().empty();
    }
</script>
@endsection