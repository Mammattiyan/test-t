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
                <span class="user-info">Name: Shay Laren</span><br>
                <span class="user-info">Age: 28</span><br>
                <span class="user-info">Height: 6"2</span><br>
                <span class="user-info">Relationship story: Single</span><br>
                <span class="user-info">Location: Georgia</span><br><br>
                <span>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.<br><br> Enim ad minim veniam, quis nostrud exercitation love.</span>
            </div>
            <div class="box pad photo-gallery">
                <div class="thick-text">Photos</div>
                <img src="{{ asset('assets/gallery11.jpg')}}" class="featured-photo" data-pv="1">
                <img src="{{ asset('assets/gallery1.jpg')}}" data-pv="2">
                <img src="{{ asset('assets/gallery4.jpg')}}" data-pv="3">
                <img src="{{ asset('assets/gallery6.jpg')}}" data-pv="4">
                <img src="{{ asset('assets/gallery3.jpg')}}" data-pv="5">
                <img src="{{ asset('assets/gallery5.jpg')}}" data-pv="6">
                <img src="{{ asset('assets/gallery7.jpg')}}" data-pv="7">
                <img src="{{ asset('assets/gallery2.jpg')}}" data-pv="8">
                <img src="{{ asset('assets/gallery8.jpg')}}" data-pv="9">
                <img src="{{ asset('assets/gallery9.jpg')}}" data-pv="10">
                <img src="{{ asset('assets/gallery10.jpg')}}" data-pv="11">
            </div>
            <div class="box pad video-gallery">
                <div class="thick-text">Videos</div>
                <div class="vg-item-wrap featured-vg-item">
                    <div class="vg-item">
                        <iframe width="560" height="315" src="http://www.youtube.com/embed/BG-9SXdDWmE?showinfo=0&rel=0" frameborder="0" allowfullscreen="1" class="video"></iframe>
                    </div>
                </div>
                <div class="vg-item-wrap">
                    <div class="vg-item">
                        <iframe width="560" height="315" src="http://www.youtube.com/embed/1UvPZ8fD4B8?showinfo=0&rel=0" frameborder="0" allowfullscreen="1" class="video"></iframe>
                    </div>
                </div>
                <div class="vg-item-wrap">
                    <div class="vg-item">
                        <iframe width="560" height="315" src="http://www.youtube.com/embed/MlUt54ESu78?showinfo=0&rel=0" frameborder="0" allowfullscreen="1" class="video"></iframe>
                    </div>
                </div>
                <div class="vg-item-wrap">
                    <div class="vg-item">
                        <iframe width="560" height="315" src="http://www.youtube.com/embed/PPU2L38LcJw?showinfo=0&rel=0" frameborder="0" allowfullscreen="1" class="video"></iframe>
                    </div>
                </div>
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