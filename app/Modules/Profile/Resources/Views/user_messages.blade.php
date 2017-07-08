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
            <div class="box pad message-height" id="message-container">
                <div class="thick-text">Messages</div>
                <ul class="chat">
                    @if(!empty($message))
                    @foreach($message as $val)
                    <li class="{{$val->position}} clearfix"><span class="chat-img pull-{{$val->position}}">
                            <img src="{{ URL::to($val->profileimage)}}" alt="User Avatar" class="img-circle" />
                        </span>
                        <div class="chat-body clearfix">
                            <div class="header_msg">
                                @if($val->position == "left")
                                <strong class="primary-font">{{$val->name}}</strong> 
                                <small class="pull-right text-muted"><span class="glyphicon glyphicon-time"></span>{{$val->created_at}}</small>
                                @else
                                <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>{{$val->created_at}}</small>
                                <strong class="pull-right primary-font">{{$val->name}}</strong>
                                @endif
                            </div>
                            @if($val->position == "left")
                            <p class="text-left">{{$val->message}}</p>
                            @else
                            <p class="text-right">{{$val->message}}</p>
                            @endif
                        </div>
                    </li>
                    @endforeach
                    @endif

                </ul>
            </div>
            <div class="box">
                <div class="pad">
                    {!! Form::open(array('url'=>'profile/message/'.$user['id'],'id'=>'sendMessage','method'=>'post')) !!} 
                    <div class="message-field">
                        <input type="hidden" name="receiver" value="{{$user['id']}}">
                        <input type="text" name="message" id="message" placeholder="Message">
                        <a class="fa fa-paper-plane" href="javascript:void(0)" onclick="sendMessage()"></a>
                    </div>
                    {!! Form::close() !!}
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
        $("#sendMessage").submit(function (event) {
            sendMessage()
            event.preventDefault();
        });
    });
    $('#message-container').scrollTop($('#message-container').prop("scrollHeight"));
    function sendMessage() {
        $.ajax({
            url: '{!! URL::to("profile/sendMessage") !!}',
            data: $('#sendMessage').serialize(),
            type: 'POST',
            dataType: 'JSON',
            success: function (data) {
                $('#message').val('');
                var msg = '<li class="right clearfix"><span class="chat-img pull-right">\n\
                            <img src="{{ URL::to($val->profileimage)}}" alt="User Avatar" class="img-circle" />\n\
                        </span>\n\
                        <div class="chat-body clearfix">\n\
                            <div class="header_msg">\n\
                                <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>Just now</small>\n\
                                <strong class="pull-right primary-font">' + data.name + '</strong>\n\
                            </div> \n\
                            <p class="text-right">' + data.message + '</p> \n\
                        </div> \n\
                    </li>';
                $('.chat').append(msg);
                $(".message-height").animate({scrollTop: $('.message-height').prop("scrollHeight")}, 1000);
            }
        });
    }


</script>
@endsection