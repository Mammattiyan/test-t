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
        <div class="alert alert-success text-center">
            <strong>Success!</strong>
            <p>Successful sent dine Request.</p>
        </div>s
        <script type="text/javascript">
            //here double curly bracket
            window.setTimeout(function () {
                window.location = "{{ URL::to('/profile') }}";
            }, 1000);
        </script>
        @endif
            <div class="box pad">
                {{ Form::open(array('url' => 'dine/sent'.'/'.$token)) }}
                <div class="thick-text">Send Dine Request</div>
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
                            <input type="text" name="date"  value="" id="hangoutDate" required >
                        </div>
                        <div class="row">
                            <label>Time <span class="text text-danger">*</span></label>
                            <input type="text" name="time" value="" id="hangoutTime" required>
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
