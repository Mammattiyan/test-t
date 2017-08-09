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
            </div>
            <script type="text/javascript">
                window.setTimeout(function () {
                    window.location = "{{ URL::to('/profile') }}";
                }, 1000);
            </script>
            @endif
            <div class="box pad">
                {{ Form::open(array('url' => 'hangout/sent'.'/'.$token)) }}
                <div class="thick-text">Send Hangout Request</div>
                <div class="accordion-group">
                    <div class="accordion">
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
                        <div class="row">
                            <label>Private <span class="text text-danger">*</span></label>
                            <div class="radioRow"><input type="radio" name="private_hangout" value="yes" checked><label>Yes</label>
                            <input type="radio" name="private_hangout" value="no"><label>No</label>
                            </div> 
                        </div>
                        <div class="row">
                            <label>Accompany <span class="text text-danger">*</span></label>
                            <div class="radioRow"><input type="radio" name="accompany_hangout" value="yes" checked><label>Yes</label>
                            <input type="radio" name="accompany_hangout" value="no"><label>No</label>
                            </div> 
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
