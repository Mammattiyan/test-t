@extends('layouts.app')
@section('title')
Itweetup :: Activities
@endsection
@section('content')
<?php //dd($token,$errors); ?>
<div class="flex-item updates-block">
    <div class="box">
        <div class="pad">
            <div class="thick-text">Profile Completion</div>
            <div class="progress-bar">
                <div class="perc-text">70%</div>
                <div class="perc-bar"></div>
            </div>
        </div>
        <hr>


        @if (count($errors)>0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors  as $key=>$value)
                <li >{{ $value }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if(isset($status) == 1)
        <div class="alert alert-success">
            <strong>Success!</strong> Successful sent hangout message.
        </div>
        <script type="text/javascript">
            //here double curly bracket
            window.setTimeout(function () {
                window.location = "{{ asset('/profile') }}";
            }, 1000);
        </script>
        @endif


        <div class="box pad">

            {{ Form::open(array('url' => 'hangout/sent'.'/'.$token)) }}

            <div class="thick-text">Hangout</div>
            <div class="accordion-group">
                <div class="accordion">

                    <label>Event</label>
                    <input type="text" name="event" required >
                    <br>
                    <label>Location</label>
                    <input type="text" name="location" required >
                    <br>
                    <label>Date</label>
                    <input type="text" name="dob" id="hangoutDate" required >
                    <br>
                    <label>Time</label>
                    <input type="text" name="time" id="hangoutTime" required>
                    <br>
                    <label>Private</label>
                    <input type="text" name="private" required>
                    <br>
                    <label>Accompany</label>
                    <input type="text" name="accompany">
                    <br>
                    <label>Family Member</label>
                    <input type="text" name="family_member">
                    <br>
                    <div class="flex-item text-right">
                        <input type="submit" name="editpic" class="button" value="Submit">
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>


</script>