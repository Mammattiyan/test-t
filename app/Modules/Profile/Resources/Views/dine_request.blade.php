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
            <div class="alert alert-success text-center" id="success" style="display: none">
                <strong>Success</strong>
                <p>Dining Request Accepted!</p>
            </div>
            <div class="alert alert-danger text-center" id="notSuccess" style="display: none">
                <strong>Rejected</strong>
                <p>Dining Request Rejected!</p>
            </div>

            <div class="box pad " id="request-container">
                <div class="thick-text text-center">Dining Request</div>
                <div class="accordion-group">
                    <div class="accordion"> 

                        {{ Form::hidden('dineId', $dine['id'], array('id' => 'dineId')) }}
                        <div class="row">
                            <table class="table-center">
                                <tr>
                                    <td class="text-right">
                                        <strong>Event </strong>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span>{{ $dine['event']  or "" }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right">
                                        <strong>Location </strong>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span>{{ $dine['location']  or "" }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right">
                                        <strong>Date </strong>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span>{{ $dine['date']  or "" }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right">
                                        <strong>Time </strong>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span>{{ $dine['time']  or "" }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right">
                                        <strong>Private </strong>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span>{{ $dine['private']  or "" }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right">
                                        <strong>Accompany </strong>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span>{{ $dine['accompany']  or "" }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right">
                                        <strong>Family Member </strong>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span>{{ $dine['family_member']  or "" }}</span>
                                    </td>
                                </tr>
                                @if($dine['sender_id']==Auth::user()->id)
                                <tr>
                                    <td class="text-right">
                                        <strong>Status</strong>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span>Request {{ ucfirst($dine['dine_status'])}}</span>
                                    </td>
                                </tr>
                                @else
                                @if($dine['dine_status']!='sent')
                                <tr>
                                    <td class="text-right">
                                        <strong>Status</strong>
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <span>Request {{ ucfirst($dine['dine_status'])}}</span>
                                    </td>
                                </tr>
                                @endif
                                @endif
                            </table>                            
                        </div>   
                        <div class="flex-item text-right">
                            @if($dine['sender_id']!=Auth::user()->id)
                            @if($dine['dine_status']=='sent' || $dine['dine_status']=='requested')
                            <input type="button"  class="button buttonDine" value="accept">
                            <input type="button"  class=" button buttonDine" value="reject">

                            @endif
                            @endif
                            <a href="{{ URL::to('dine')}}"  class=" button" > Back</a>
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

@section('js')
<script>
    $(document).ready(function () {
        $('.buttonDine').click(function () {
            var status = $(this).val();
            $('#request-container').hide();
            var dineId = $('#dineId').val();
            $.ajax({
                url: '{!! URL::to("profile/diningStatus") !!}',
                data: {dineId: dineId, status: status, _token: '{{{csrf_token()}}}'},
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
                            window.location = "{{ URL::to('/dine') }}";
                        }, 1000);
                    } else {
                    }
                }
            });
        });
    });



</script>
@endsection