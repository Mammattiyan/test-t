@extends('layouts.app')
@section('title')
Itweetup :: Message
@endsection
@section('content')
<div class="flex-item updates-block">
    @include('search::search_form')
    <div class="box pad">
        <div class="thick-text">Messages</div>
        @foreach($messages as $key =>$value)
        <div class="activity">
            <img src="{{asset($value['profileimage'])}}" class="user-icon">
            <div class="activity-text">
                <div class="bold-text">{{$value['messager_name']}}</div>
                <div class="activity-details">{{$value['message']}}</div>
                <div class="timestamp"> {{$value['created_at']}}</div>
            </div>
        </div>
        @endforeach
      
    </div>
@endsection