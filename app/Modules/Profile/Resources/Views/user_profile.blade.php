
@extends('profile::app')
@section('title')
Itweetup :: Activities
@endsection
@section('content')

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
@endsection