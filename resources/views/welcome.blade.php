<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <title>itweetup :: Login</title>
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css')}}">
        <script src="https://code.jquery.com/jquery-1.8.2.min.js"></script>
        <script src="{{ asset('js/jquery.popupoverlay.js')}}"></script>
        <script src="{{ asset('js/dobPicker.min.js')}}"></script>
    </head>
    <body class="flex-box fd-col login-body">
        <div class="flex-item flex-box">
            <div class="container flex-box fd-col fd-md-row">
                <div class="flex-item">
                    <div class="header">
                        <a href="login.html" class="header-logo"><img src="{{ URL::to('images/itweetup -Logo copy.png') }}"/></a>
                    </div>
                </div>
                <div class="flex-item login-form-wrap">
                    <div class="box pad">
                        <form id="login-form" action="{{ url('/login') }}" method="post" class="form-signin" role="form">

                            <input type="text" name="login" id="login" value="{{ Request::old('login') }}" autofocus required placeholder="Phone, email or username">

                            @if ($errors->has('login'))
                            <span class="help-block">
                                <strong>{{ $errors->first('login') }}</strong>
                            </span>
                            @endif

                            <input type="password" name="password" id="password" value="{{ Request::old('password') }}" placeholder="Password">
                            @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                            <div class="flex-box">
                                <div class="flex-item">
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}>
                                           <label for="remember-me">Remember Me</label>
                                </div>
                                <div class="flex-item text-right">
                                    <a href="{{ url('/password/reset') }}" class="block-form-control">Forgot Password?</a>
                                    <input type="submit" name="btn_login" class="button" value="Login">
                                </div>
                            </div>
                            {{ csrf_field() }}

                        </form>
                        <div class="thick-text">New to <span style="color:#F00;">i</span>tweetup?</div>
                        <form id="registration-form" onSubmit="return checkForm(this, event);" action="{{ url('/register') }}" method="post" class="form-signin" role="form">
                            <input type="text" name="username" id="username" value="{{ Request::old('username') }}" type="text" autofocus required placeholder="User Name">
                            @if ($errors->has('username'))
                            <span class="help-block">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                            @endif
                            <input  type="email" name="email" id="email" value="{{ Request::old('email') }}" autofocus required placeholder="Email" >
                            @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                            <input type="password" name="password" id="password" value="{{ Request::old('password') }}" autofocus required placeholder="Password">
                            @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                            <div class="flex-box">
                                <div class="flex-item">
                                    <input type="checkbox" required name="agree" id="agree">
                                    <label for="agree">Agree to <a href="#">Terms &amp; Conditions</a></label>
                                </div>
                                <span class="agree-error help-block" style="display:none;">

                                </span>
                                <div class="flex-item text-right">
                                    <a class="initialism basic_open " href="#basic"></a>
                                    <input type="button" id="form-button" name="register" class="button" value="Sign Up">
                                    <input type="submit" id="form-submit" style="display:none" name="register" class="button" value="Sign Up">
                                </div>
                            </div>





                            <div id="basic" class="well" style="max-width:44em;text-align: center;">
                                <h4 style="text-align: center;">Date of birth</h4>
                                <div class="row">							
                                    <select id="dobday" class="form-control"></select>
                                    <select id="dobmonth"  class="form-control"></select>
                                    <select id="dobyear"  class="form-control"></select>
                                </div>

                                <div class="row">
                                    <p class="error"  style="display:none">You must be over 18 to register</p>
                                </div>							<div class="row" style="text-align: center;">							
                                    <button id="date_submit" class="basic_submit fade_open btn btn-default btn-small">Submit</button>
                                </div>
                            </div>

                            {{ csrf_field() }}
                        </form>
                        <div class="flex-box info-icons-wrap text-center">
                            <div class="flex-item">
                                <img src="assets/trusted.png">
                                <div class="bold-text">Trusted</div>
                            </div>
                            <div class="flex-item">
                                <img src="assets/continental.png">
                                <div class="bold-text">Continental</div>
                            </div>
                            <div class="flex-item">
                                <img src="assets/simple.png">
                                <div class="bold-text">Simple</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex-item footer">
            <div class="container flex-box fd-col fd-lg-row">
                <div class="flex-item">
                    <div class="footer-nav">
                        <a data-modal="about-us">About Us</a>
                        <a href="#">Feedback</a>
                        <a href="#">Contact Us</a>
                        <a href="#">Dating Tips</a>
                        <a href="#">First Date?</a>
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
                <div class="flex-item">
                    <div class="copyright">itweetup © 2016</div>
                </div>
            </div>
        </div>
        <div class="modal-glass hide">
            <div class="modal">
                <div class="modal-heading"></div>
                <div class="modal-body"></div>
                <div class="modal-close"></div>
            </div>
        </div>
        <div class="hide" data-modal-contents-wrap>
            <div data-modal-content="about-us">
                <div data-modal-heading>About Us</div>
                <div data-modal-body>
                    <div class="thick-text">Who are we?</div>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br><br>
                    <div class="thick-text">What we do...</div>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br><br>
                    <div class="thick-text">How we do it!</div>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br><br>
                    <div class="thick-text">How we do it!</div>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br><br>
                    <div class="thick-text">How we do it!</div>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br><br>
                    <div class="thick-text">How we do it!</div>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function () {
                $('#basic').popup();
                $.dobPicker({
                    daySelector: '#dobday', /* Required */
                    monthSelector: '#dobmonth', /* Required */
                    yearSelector: '#dobyear', /* Required */
                    dayDefault: 'Day', /* Optional */
                    monthDefault: 'Month', /* Optional */
                    yearDefault: 'Year', /* Optional */
                    minimumAge: 12, /* Optional */
                    maximumAge: 80 /* Optional */
                });
                $('#form-button').on('click', function () {
                    if (!$('#registration-form')[0].checkValidity())
                    {
                        $('#form-submit').trigger('click');
                    } else {
                        $('.basic_open').trigger('click');
                    }
                });
                $('#date_submit').on('click', function () {

                    if (isNaN(parseInt($("#dobyear").val())) || isNaN(parseInt($("#dobyear").val())) || isNaN(parseInt($("#dobyear").val()))) {
                        $('.error').show();
                        $('.error').text("Please select your date of birth");
                    } else {
                        if (2017 - parseInt($("#dobyear").val()) > 17) {

                            $('#form-submit').trigger('click');
                        } else {
                            if (isNaN(parseInt($("#dobyear").val()))) {
                                $('.error').show();
                                $('.error').text("Please select your date of birth");
                            } else {
                                $('.error').show();
                                $('.error').text("You must be over 18 to register");
                            }
                        }
                    }
                });
            });
        </script>
    </body>
</html>