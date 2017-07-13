@extends('profile::app')
@section('title')
Itweetup :: Activities
@endsection
@section('content')

<div class="main-section">
    <div class="container flex-box fd-col fd-lg-row equisized-lg-items">
        <div class="flex-item userdata-block">
            <div class="box userinfo-tile">
                <img src="{{ URL::to($user['profileimage'])}}" class="user-photo">
                <div class="pad">
                    <div class="thick-text">{{ ucfirst($user['name'])}}</div>
                    <div class="user-motto">Real beauty is always inside</div>
                </div>
            </div>
            <div class="box pad nav-tile">
                <div class="thick-text">Links</div>
                <ul class="nav-links">
                    <li class="nav nav-message"><a href="{{ URL::to('profile/message').'/'.$user['id']}}">Message</a></li>
                    <li class="nav nav-hangout"><a href="#">Hangout</a></li>
                    <li class="nav nav-chat"><a href="#">Chat</a></li>
                    <li class="nav nav-dining"><a href="#">Dine</a></li>
                </ul>
            </div>
        </div>
        <div class="flex-item updates-block">
            <div class="box">
                <div class="pad">
                    <div class="search-field">
                        <input type="text" name="search-stuff" placeholder="Search">
                        <a href="#"></a>
                    </div>
                </div>
            </div>
            <div class="alert alert-success text-center" id="success" style="display: none">
                <strong>Success</strong>
                <p>Hangout status updated!</p>
            </div>
            
            <div class="box pad ">
                <div class="thick-text">Send Hangout Request</div>
                <div class="accordion-group">
                    <div class="accordion"> 

                        {{ Form::hidden('hangId', $hangout['id'], array('id' => 'hangId')) }}
                        <div class="row">
                            <div class="col col-md-6">                                
                                <label>Event <span class="text text-danger">*</span></label>
                            </div>

                            <div class="col col-md-6">                                
                                <input type="text" name="event" value="{{ $hangout['event']  or "" }}" readonly >                        
                            </div>
                        </div>
                        <div class="row">
                            <label>Location <span class="text text-danger">*</span></label>
                            <input type="text" name="location" value="{{ $hangout['location']  or "" }}" readonly >                      
                        </div>

                        <div class="row">
                            <label>Date <span class="text text-danger">*</span></label>
                            <input type="text" name="date"  value="{{ $hangout['date']  or "" }}" readonly >
                        </div>
                        <div class="row">
                            <label>Time <span class="text text-danger">*</span></label>
                            <input type="text" name="time" value="{{ $hangout['time']  or "" }}" readonly>
                        </div>
                        <div class="row">
                            <label>Private <span class="text text-danger">*</span></label>
                            <input type="text" name="private" value="{{ $hangout['private']  or "" }}" readonly>
                        </div>
                        <div class="row">
                            <label>Accompany <span class="text text-danger">*</span></label>
                            <input type="text" name="accompany" value="{{ $hangout['accompany']  or "" }}" readonly >
                        </div>
                        <div class="row">
                            <label>Family Member <span class="text text-danger">*</span></label>
                            <input type="text" name="family_member" value="{{ $hangout['family_member']  or "" }}" readonly>
                        </div>
                        <div class="flex-item text-right">
                            <input type="button"  class="button buttonHang" value="accept">
                            <input type="button"  class=" button buttonHang" value="reject">
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>

        </div>
        <div class="flex-item">
            <div class="box pad">
                <div class="thick-text">Chat</div>
                <div>Chatbox here</div>
            </div>
            <div class="box pad">
                <div class="thick-text">Advertisement</div>
                <div>Promotions here</div>
            </div>
            <div class="copyright">itweetup &copy; 2016</div>
        </div>
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

@section('js')
<script>


    $(document).ready(function () {

        $('.buttonHang').click(function () {

            var status = $(this).val();
            var hangId = $('#hangId').val();
            $.ajax({
                url: '{!! URL::to("profile/hangoutStatus") !!}',
                data: {hangId: hangId, status: status, _token: '{{{csrf_token()}}}'},
                type: 'POST',
                dataType: 'JSON',
                success: function (data) {

                    if (data.status == '1') {

                        $('#success').show();
                    }else{
                        $('#notSuccess').show();
                    }
                }
            });
        });
    });



</script>
@endsection