@extends('layouts.app')
@section('title')
Itweetup :: Activities
@endsection
@section('content')
<style>
    .dropdown{
        height: 36px;
    }
    .inputField{
        width: 100%;
    }
    .parsley-required{
        color: red;
    }
</style>
<div class="flex-item updates-block">
    <div class="box">
        @include('search::search_form')
        <hr>
    </div>
    <div class="box pad ">
        {{ Form::open(array('url' => '#', 'method' => 'post', 'id' => 'editProfile')) }}
        <div class="thick-text">Edit profile</div>
        <div class="accordion-group">
            <div class="accordion">
                <div class="accordion-title">Personal Details</div>
                <div class="accordion-content" style="display: block;">
                    <div class="formRow">
                        <label>Motto</label>
                        <div><input type="text" name="motto" value="{{$data['motto_name']->name or ''}}" required></div> 
                    </div>
                    <div class="formRow">
                        @if(count($data['gender_preference'])>0)
                        <label>Your Gender & Preference</label>
                        @foreach($data['gender_preference'] as $val)
                        <div class="radioRow"><input type="radio" name="gender_preference_id" value="{{$val->id}}"><label>{{$val->gender_preference_name}}</label></div> 
                        @endforeach
                        @endif
                    </div>
                    <div class="formRow">
                        @if(count($data['marital_status'])>0)
                        <label>What is your marital status?</label>
                        @foreach($data['marital_status'] as $val)
                        <div class="radioRow"><input type="radio" name="marital_status_id" value="{{$val->id}}"><label>{{$val->marital_status}}</label></div> 
                        @endforeach
                        @endif
                    </div>
                    <div class="formRow">
                        <label>Height</label>
                        <div class="radioRow">{!! Form::select('height', $data['height'], [], ['class' => 'dropdown', 'required']) !!}</div> 
                    </div>
                    <div class="formRow">
                        <label>If you are NRI choose your ethnic origin</label>
                        <div class="radioRow">{!! Form::select('height', $data['height'], [2=>2], ['class' => 'dropdown', 'required']) !!}</div> 
                    </div>
                </div>
            </div>
            <div class="accordion">
                <div class="accordion-title">Personal Appearance</div>
                <div class="accordion-content" style="display: none;">

                </div>
            </div>
            <div class="accordion">
                <div class="accordion-title">Social &amp; Lifestyle</div>
                <div class="accordion-content" style="display: none;">

                </div>
            </div>
            <div class="flex-item text-right">
                <label id="result"></label>
                <input type="button" name="editpic" class="button" value="Submit" onclick="updateProfile()">
            </div>
        </div>
        {{ Form::close() }}
    </div>
</div>

@endsection

@section('js')
<script>
    $('select').select2({
        minimumResultsForSearch: -1
    });

    function updateProfile() {
        $('#editProfile').parsley().validate();
        if ($('#editProfile').parsley().isValid()) {
            $.ajax({
                url: "{{URL::to('profile/update')}}",
                type: "POST",
                dataType: "json",
                data: $('#editProfile').serialize(),
                success: function (data) {
                    $("#result").html(data.msg);
                    setTimeout(function () {
                        $("#result").hide('slow');
                    }, 6000);
                }
            });
        }
    }
</script>
@endsection