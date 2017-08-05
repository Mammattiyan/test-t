<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Chatroom using SocketIOn NodeJS and MySQL - jQuery Ajax PHP</title>
        <link rel="stylesheet" href="{{ asset('nchat/css/style.css')}}">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Merriweather:300italic' rel='stylesheet' type='text/css'>
        <script src="{{ asset('nchat/js/jquery.js')}}"></script>
        <script src="{{ asset('nchat/js/socket.io.js')}}"></script>
        <script src="{{ asset('nchat/js/slimscroll.js')}}"></script>
        <script src="{{ asset('nchat/js/moment.js')}}"></script>
        <script src="{{ asset('nchat/js/livestamp.js')}}"></script>
    </head>
    <body>


        <div class="container">
            <div id="userinfo">
                <input type="text" id="username" autocomplete="off">
                <div class="validation"></div>
            </div>
            <div id="chat-body">
                <div class="chat-header">
                    <span>Live chatroom with SocketIO, NodeJS and MySQL</span>
                </div>
                <div class="chat-holder">
                    <div class="names-holder">
                        <ul class="names-list">

                        </ul>
                    </div>

                    <div class="message-holder">
                        <ul class="messages">
                        </ul>
                    </div>

                    <input type="text" class="message-box" placeholder="Your message">
                </div>
            </div>
        </div>

        <script >
$(function () {
    var socket = io.connect('http://' + window.location.hostname + ':3000');

    socket.on('users', function (data) {
        $('.names-list').text('');
        $.each(data, function (i, v) {
            $('.names-list').append('<li>' + v + '</li>');
        });
    });

    socket.on('push message', function (response) {
        $('.messages').append('<li><div class="msg-lhs"><span class="username">' + response.name + '</span> : <span class="msg">' + response.msg + '</span></div><span data-livestamp="' + moment().unix() + '" class="msg-rhs"></span></li>');
        $('.messages').animate({scrollTop: $('.messages').prop("scrollHeight")}, 500);
    });

    $(document).on('keyup', '.message-box', function (e) {
        var $this = $(this);
        if (e.which === 13) {
            var message = $this.val();
            socket.emit('new message', message);
            $this.val('');
            updateDB(localStorage.getItem('username'), message); //Update message in DB
        }
    });

    function updateDB(name, msg) {
        $.post('{{URL:to("chat/update")}}', {method: 'update', name: name, msg: msg}, function (response) {
            console.log(response);
        });
    }

    $('#username').on('keyup', function (e) {
        var $this = $(this);
        if (e.which === 13) {
            var name = $this.val();
            socket.emit('new user', name, function (response) {
                if (response) {
                    localStorage.setItem('username', name);
                    $this.val('');
                    $('#userinfo').hide();
                    $('#chat-body').fadeIn();
                    loadMessages(); //retrieve messages from Database
                } else {
                    $('.validation').text('Username taken!').fadeIn();
                }
            });
        }
    });

    function loadMessages() {
        $.post('process.php', {method: 'retrieve'}, function (response) {
            $.each(JSON.parse(response), function (i, v) {
                $('.messages').append('<li><div class="msg-lhs"><span class="username">' + v.name + '</span> : <span class="msg">' + v.message + '</span></div><span data-livestamp="' + v.created_at + '" class="msg-rhs"></span></li>');
            });
            $('.messages').animate({scrollTop: $('.messages').prop("scrollHeight")}, 500);
        });
    }

    /*** App ***/

    $('.names-list').slimScroll({
        width: '200px',
        height: '400px',
        color: '#ffcc00'
    });

    $('.messages').slimScroll({
        width: '500px',
        height: '350px',
        color: '#3092BF',
        alwaysVisible: true,
        start: 'bottom'
    });
});
        </script>	

    </body>
</html>