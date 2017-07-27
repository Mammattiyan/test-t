@extends('layouts.app')
@section('title')
Itweetup :: Activities
@endsection
@section('content')
<!-- styles -->
<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.fileuploader.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.fileuploader-theme-thumbnails.css') }}">




<!-- js -->

<style>

    .photos {
        font-family: 'Roboto', sans-serif;
        font-size: 14px;
        line-height: normal;
        color: #47525d;
        background-color: #fff;

        margin: 0;
        padding: 20px;

        width: 560px;
    }
</style>            


<div class="flex-item updates-block">
    <div class="box">
        @include('search::search_form')
        <hr>
        <div class="pad">
            <div class="thick-text">Profile Completion</div>
            <div class="progress-bar">
                <div class="perc-text">70%</div>
                <div class="perc-bar"></div>
            </div>
        </div>
        <div class="activity photos">
            <form action="php/form_upload.php" method="post" enctype="multipart/form-data">
                <input type="file" name="files">
                <input type="submit">
            </form>
        </div>

    </div>

</div>
@endsection





