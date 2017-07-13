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
                <p>Hangout Request Accepted!</p>
            </div>
            <div class="alert alert-danger text-center" id="notSuccess" style="display: none">
                <strong>Rejected</strong>
                <p>Hangout Request Rejected!</p>
            </div>

            <div class="box pad " id="request-container">
                <div class="thick-text text-center">Hangout Request</div>
                <div class="accordion-group">
                    <div class="accordion"> 

                        {{ Form::hidden('hangId', $hangout['id'], array('id' => 'hangId')) }}
                        <div class="row">
                            <table class="table-center">
                                <tr>
                                    <td class="text-right">
                                        <strong>Event </strong>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span>{{ $hangout['event']  or "" }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right">
                                        <strong>Location </strong>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span>{{ $hangout['location']  or "" }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right">
                                        <strong>Date </strong>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span>{{ $hangout['date']  or "" }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right">
                                        <strong>Time </strong>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span>{{ $hangout['time']  or "" }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right">
                                        <strong>Private </strong>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span>{{ $hangout['private']  or "" }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right">
                                        <strong>Accompany </strong>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span>{{ $hangout['accompany']  or "" }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right">
                                        <strong>Family Member </strong>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span>{{ $hangout['family_member']  or "" }}</span>
                                    </td>
                                </tr>
                                @if($hangout['hangout_status']!='sent')
                                <tr>
                                    <td class="text-right">
                                        <strong>Status</strong>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span>{{ ucfirst($hangout['hangout_status'])}}</span>
                                    </td>
                                </tr>
                                @endif
                            </table>                            
                        </div>   
                        <div class="flex-item text-right">
                            @if($hangout['hangout_status']=='sent' || $hangout['hangout_status']=='requested')
                            <input type="button"  class="button buttonHang" value="accept">
                            <input type="button"  class=" button buttonHang" value="reject">

                            @endif
                            <a href="{{ URL::to('hangout')}}"  class=" button buttonHang" > Back</a>
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
            $('#request-container').hide();
            var hangId = $('#hangId').val();
            $.ajax({
                url: '{!! URL::to("profile/hangoutStatus") !!}',
                data: {hangId: hangId, status: status, _token: '{{{csrf_token()}}}'},
                type: 'POST',
                dataType: 'JSON',
                success: function (data) {
                    if (data.status == '1') {
                        if (status == 'reject') {
                            $('#notSuccess').show();
                        } else {
                            $('#success').show();
                        }
                        window.setTimeout(function () {
                            window.location = "{{ URL::to('/hangout') }}";
                        }, 1000);
                    } else {
                    }
                }
            });
        });
    });



</script>
@endsection