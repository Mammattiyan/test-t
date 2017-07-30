@extends('layouts.app')
@section('title')
Itweetup :: Activities
@endsection
@section('content')
<?php $images =[]; ?>
<link href="{{ asset('plugins/videoUpload/css/jquery.fileuploader-theme-dragdrop.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/videoUpload/css/jquery.fileuploader-theme-thumbnails.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/videoUpload/css/jquery.fileuploader.css') }}" rel="stylesheet">
<div class="flex-item updates-block">
    <div class="box">
        @include('search::search_form')
        <hr>

    </div>
    <div class="box pad">      
        <div class="box pad video-gallery">
            <div class="thick-text">Videos</div>
            <div class="vg-item-wrap featured-vg-item">
                <div class="vg-item">
                      <input type="file" name="files" data-fileuploader-files='<?php echo json_encode($images)?>'>                      
                </div>
            </div>
           
        </div>
    </div>
</div>
<!--<div class="vg-item-wrap featured-vg-item">
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
            </div>-->
@endsection
@section('js')
               <script src="{{ asset('plugins/videoUpload/js/customthumb.js')}}"></script> 

@endsection