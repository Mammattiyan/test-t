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

<!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkC8RKIPZZeg9rH8MWYteBqks0l6DNj5c"></script>-->
        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?libraries=places&sensor=false&key=AIzaSyAkC8RKIPZZeg9rH8MWYteBqks0l6DNj5c"></script>
        <script src="{{ asset('js/jquery.geocomplete.js')}}"></script>
        <script src="{{ asset('js/logger.js')}}"></script>
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
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
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


                        </form>
                        <div class="thick-text">New to <span style="color:#F00;">i</span>tweetup?</div>
                        <form id="registration-form" onSubmit="return checkForm(this, event);" action="{{ url('/register') }}" method="post" class="form-signin" role="form">
                            <input type="hidden" name="dob" id="dob">
                            <input type="hidden" name="gender" id="gender">
                            <input type="hidden" name="place" id="place">
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
                                <h4 style="text-align: left; margin-bottom:5px;">Date of birth</h4>
                                <div class="row">							
                                    <select id="dobday" class="form-control"></select>
                                    <select id="dobmonth"  class="form-control"></select>
                                    <select id="dobyear"  class="form-control"></select>
                                </div>
                                <div class="row" style="margin-top: 10px;">							
                                    <input type="radio" name="gender" value="M"> Male
                                    <input type="radio" name="gender" value="F"> Female
                                </div>
                                <div class="row">							
                                    <input id="geocomplete" name="place" type="text" placeholder="Type in an address" size="90" />
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
                            <div class="flex-item" data-modal="trusted">
                                <img src="assets/trusted.png">
                                <div class="bold-text">Trusted</div>
                            </div>
                            <div class="flex-item" data-modal="continental">
                                <img src="assets/continental.png">
                                <div class="bold-text">Continental</div>
                            </div>
                            <div class="flex-item" data-modal="simple">
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
                        <a data-modal="feedback" >Feedback</a>
                        <a data-modal="contact-us" >Contact Us</a>
                        <a data-modal="dating-tips" >Dating Tips</a>
                        <a data-modal="first-date" >First Date?</a>
                        <a data-modal="conditions" >Terms &amp; Conditions</a>
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
                    <div class="thick-text">Who are we?</div>Itweetup verifies users credibility based on the documents user/member provide us and its matched and checked with external document verification service providers and users on the itweetup; who has CV highlighted on their profiles are the members who have verified their Citizenship with itweetup and this makes them more authentic/true members. <br><br>

                </div>
            </div>
        </div>
        <div class="hide" data-modal-contents-wrap>
            <div data-modal-content="feedback">
                <div data-modal-heading>Send Feedback</div>
                <div data-modal-body>
                    <div class="box pad">
                        {{ Form::open(array('url' => 'feedback')) }}
                        <div class="col col-md-6">
                            <div class="row">
                                <label>Full name <span class="text text-danger">*</span></label>
                                <input type="text" name="full_name" value="" required >                        
                            </div>
                            <div class="row">
                                <label>Email <span class="text text-danger">*</span></label>
                                <input type="email" name="email" value="" required >                      
                            </div>

                            <div class="row">
                                <label>Web <span class="text text-danger">*</span></label>
                                <input type="url" name="web"  value=""  required >
                            </div>                                

                        </div>
                        <div class="col col-md-6" >
                            <div class="row">
                                <label>Feedback <span class="text text-danger">*</span></label>
                                <textarea type="text" name="feedback" rows="7" value="" required ></textarea>                       
                            </div>                                   

                            <div class="flex-item text-right">
                                <input type="submit" name="submit" class="button" value="Submit">
                            </div>
                        </div>

                        {{ Form::close() }}
                    </div>
                    <br><br>

                </div>
            </div>
        </div>
        <div class="hide" data-modal-contents-wrap>
            <div data-modal-content="trusted">
                <div data-modal-heading>Trusted</div>
                <div data-modal-body>
                    <div class="thick-text"></div>Itweetup verifies users credibility based on the documents user/member provide us and its matched and checked with external document verification service providers and users on the itweetup; who has CV highlighted on their profiles are the members who have verified their Citizenship with itweetup and this makes them more authentic/true members. <br><br>
                </div>
            </div>
        </div>
        <div class="hide" data-modal-contents-wrap>
            <div data-modal-content="continental">
                <div data-modal-heading>Continental</div>
                <div data-modal-body>
                    <div class="thick-text"></div>Our service instantly connect people everywhere around the world and any registered user on the Itweetup can send message, chat, and send various other personal request like hangout and dinning request to any users around the world and all the features varies depending on the membership they hold with itweetup.  <br><br>
                </div>
            </div>
        </div>
        <div class="hide" data-modal-contents-wrap>
            <div data-modal-content="simple">
                <div data-modal-heading>Simple</div>
                <div data-modal-body>
                    <div class="thick-text"></div>Our service is simple and it can be accessible easily by all the users and does not require any technical knowledge to send request or view any options and itweetup does not interrupt any users regardless of the membership the hold with us advertisement and any other external promotions. <br><br>
                </div>
            </div>
        </div>
        <div class="hide" data-modal-contents-wrap>
            <div data-modal-content="dating-tips">
                <div data-modal-heading>Dating Tips</div>
                <div data-modal-body>
                    <div class="thick-text">Keep your friends in the loop</div>Tell a friend or family member where you are going, when you will return, and how to reach you, If plans change, text your friend the new details of where you'll be. <br><br>
                    <div class="thick-text">Use your own transportation</div>Either take your own car, or if you plan on drinking, take public transportation or a taxi so you don't have to rely on your date to get home.  Also, that way he won't know your address. <br><br>
                    <div class="thick-text">Meet in public</div>We recommend meeting your date in public. Not only will this decrease your chances of being put in an unsafe situation, but other people may also remember you being in that location, should something happen to you. <br><br>
                    <div class="thick-text">Bring extra money</div>Even if he's paying for dinner, carry some cash for cab fare if the date goes south. <br><br>
                    <div class="thick-text">Don't give out your personal info</div>Guard your personal contact information on any dating or social networking site,. "If using an online dating website, you can choose to have the individual respond to the site, rather than your email address, or you can set up an email address specifically for this purpose. <br><br>
                    <div class="thick-text">Use the buddy system</div>Go out with at least one other girlfriend, especially if you are headed to a place where you don't know anyone else. That way, you can help keep each other in check if one of you starts getting doe-eyed over some dude feeding you liquor or trying to get you to go home with him. <br><br>
                    <div class="thick-text">Have a plan if the buddy system fails</div>If said friend winds up disappearing from the party or the bar, have another way of getting home. Try calling or texting your friend to find out where she went, who she's with and how she plans to get home.<br>
                    "If you cannot drive, call a friend you know well or a taxi," she said. "Let someone else know what has happened, how you will be getting home and all that you know about where your friend has gone and with whom."<br>
                    <div class="thick-text">Remember that Mace still exists</div>A lot of women think it's over-the-top, but tucking some pepper spray or Mace in your purse when you go on a first date can help if he gets too grabby or tries to attack you. <br><br>
                    <div class="thick-text">Don't lie</div>This tip may seem to go against keeping your vital statistics private, but misrepresenting yourself over email or on a dating site might anger your date. "It is ill-advised to share photos or other information that is untruthful, as discovering such misrepresentation can lead to angry feelings and perhaps aggressive. <br><br>
                </div>
            </div>
        </div>
        
        <script type="text/javascript" src="{{ asset('js/bootstrap-notify.min.js') }}"></script>
        @if(isset($feedback_status) && $feedback_status==1)
        <script>
             $.notify({message: "Feedback send successfully"},{type:'success'});
        </script>
        
        @endif
        <script>
            $(document).ready(function () {
                $('#basic').popup({blur: false});
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

                            var dob = $("#dobyear").val() + '-' + $("#dobmonth").val() + '-' + $("#dobday").val();
                            $('#dob').val(dob);
                            $('#gender').val($('input[name=gender]:checked').val());
                            $('#place').val($('#geocomplete').val());

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

            $(function () {
                $("#geocomplete").geocomplete()
                        .bind("geocode:result", function (event, result) {
                            $.log("Result: " + result.formatted_address);
                        })
                        .bind("geocode:error", function (event, status) {
                            $.log("ERROR: " + status);
                        })
                        .bind("geocode:multiple", function (event, results) {
                            $.log("Multiple: " + results.length + " results found");
                        });
                $("#find").click(function () {
                    $("#geocomplete").trigger("geocode");
                });

                $("#examples a").click(function () {
                    $("#geocomplete").val($(this).text()).trigger("geocode");
                    return false;
                });
                var modalGlass = $('.modal-glass');

                // Populate and show modal
                $('[data-modal').click(function () {
                    var modalData = $('[data-modal-content="' + $(this).attr('data-modal') + '"]');

                    modalGlass.find('.modal-heading').text(modalData.find('[data-modal-heading]').text());
                    modalGlass.find('.modal-body').html(modalData.find('[data-modal-body]').html());

                    modalGlass.removeClass('hide');
                    setTimeout(function () {
                        modalGlass.find('.modal').addClass('show-modal');
                    }, 10);
                });

                // Close modal
                modalGlass.find('.modal-close').click(closeModal);
                modalGlass.click(function (event) {
                    if ($(event.target).hasClass('modal-glass')) {
                        closeModal();
                    }
                });

                function closeModal() {
                    modalGlass.addClass('hide').find('.modal').removeClass('show-modal').children().empty();
                }
            });
        </script>
    </body>
</html>