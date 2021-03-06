

@extends('layouts.app')
@section('title')
Itweetup :: Activities
@endsection
@section('css')
<!-- styles -->
<link href="{{ asset('plugins/imageUpload/css/jquery.fileuploader-theme-dragdrop.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/imageUpload/css/jquery.fileuploader-theme-thumbnails.css') }}" rel="stylesheet">
<link href="{{ asset('plugins/imageUpload/css/jquery.fileuploader.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="flex-item updates-block">
    <div class="box">
        @include('search::search_form')
        <hr>        
        <div class="card-block">                      
            {{ Form::open(array('url' => '', 'id' => 'photosForm','class'=>'m-t-40', 'enctype'=>"multipart/form-data")) }}
            <div class="row">
                <div class="col-md-8">
                    <input type="file" name="files" data-fileuploader-files='<?php echo json_encode($images) ?>'>

                </div>
            </div>
            {{ Form::close()}}
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{ asset('plugins/imageUpload/js/customthumb.js')}}"></script> 

@endsection


