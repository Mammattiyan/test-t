<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title')</title>
        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/default.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/default.date.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/multiselect.min.css') }}">       
        <link rel="stylesheet" type="text/css" href="{{ asset('css/default.time.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}">



        <!-- Custom styles for this template -->
        <link href="{{ asset('croppic/assets/css/main.css')}}" rel="stylesheet">
        <link href="{{ asset('croppic/assets/css/croppic.css')}}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('select2/css/select2.css') }}">
        <!-- Scripts -->
        @yield('css')
        <script>
            window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token(),]); ?>
        </script>
    </head>
    <body>
        <div class="header">
            <div class="container flex-box">
                <a href="{{ url('/') }}" class="header-logo"><img src="{{ URL::to('images/itweetup2.png') }}"/></a>
                <div class="user-thumbnail">
                    <img src="{{ URL::to(Auth::user()->profileimage) }}" class="menu-icon">
                    <div class="box pad menu hide">
                        <a href="{{ url('/activity') }}">Home</a>
                        <a href="{{ url('/profile/edit') }}">Edit Profile</a>
                        <a href="{{ url('/logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            </div>
        </div>        
        <div class="main-section">
            <div class="container flex-box fd-col fd-lg-row equisized-lg-items">
                @include('layouts.sidebar')
                @yield('content')
                <div class="flex-item">
                    <div class="box pad">
                        <div class="thick-text">Chat</div>
                        <div>Chatbox here</div>
                    </div>
                    <div class="copyright">itweetup &copy; 2016</div>
                </div>
            </div>
        </div>


        <script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/picker.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/picker.date.js') }}"></script>

     

        <script type="text/javascript" src="{{ asset('js/script.js') }}"></script>
   <script src="{{ asset('js/picker.time.js') }}"></script>
        <script src=" https://code.jquery.com/jquery-2.1.3.min.js"></script> 
        <script src="https://code.jquery.com/jquery-3.1.1.min.js" ></script>
        <script src="https://code.jquery.com/jquery-migrate-3.0.0.js" ></script>
        <script type="text/javascript" src="{{ asset('select2/js/select2.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/parsley.js') }}"></script>

        <script src="{{ asset('plugins/imageUpload/js/jquery.fileuploader.js')}}"></script>
        <script src="{{ asset('croppic/assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('croppic/assets/js/jquery.mousewheel.min.js') }}"></script>
        <script src="{{ asset('croppic/croppic.min.js') }}"></script>
        <!--<script src="{{ asset('croppic/assets/js/main.js') }}"></script>-->
        <!--<script type="text/javascript" src="{{ asset('select2/js/select2.js') }}"></script>-->
        <script type="text/javascript" src="{{ asset('js/parsley.js') }}"></script>
       <!-- <script type="text/javascript" src="{{ asset('js/jquery.fileuploader.min.js') }}"></script>-->
        <script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/bootstrap-notify.min.js') }}"></script>

 <!--<script src="{{ asset('croppic/assets/js/main.js') }}"></script>-->


        <script>

                            var base_url = "{{ asset('')}}";
                            var csrf_token = '{{ csrf_token() }}';
                            var croppicContainerModalOptions = {
                                uploadUrl: '{{ URL::to("profile/profileImageUpload") }}',
                                uploadData: {
                                    "_token": "{{{ csrf_token() }}}"
                                },
                                cropUrl: '{{ URL::to("profile/profileImageCrop") }}',
                                cropData: {
                                    "_token": "{{{ csrf_token() }}}"
                                },
                                modal: true,
                                imgEyecandy: false,
                                loaderHtml: '<div class="loader bubblingG"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div> ',
                                onBeforeImgUpload: function () {
                                    console.log('onBeforeImgUpload')
                                },
                                onAfterImgUpload: function () {
                                    console.log('onAfterImgUpload')
                                },
                                onImgDrag: function () {
                                    console.log('onImgDrag')
                                },
                                onImgZoom: function () {
                                    console.log('onImgZoom')
                                },
                                onBeforeImgCrop: function () {
                                    console.log('onBeforeImgCrop')
                                },
                                onAfterImgCrop: function () {
                                    $('.cropControlRemoveCroppedImage').hide();
                                    console.log('onAfterImgCrop')
                                },
                                onReset: function () {
                                    console.log('onReset')
                                },
                                onError: function (errormessage) {
                                    console.log('onError:' + errormessage)
                                }
                            }
                            var cropContainerModal = new Croppic('cropContainerModal', croppicContainerModalOptions);


                            function loadingShow() {
                                var over = '<div id="overlay">' +
                                        '<div class="bulat"> <div id="dalbulat"> <span>L</span> <span>O</span> <span>A</span> <span>D</span> <span>I</span> <span>N</span> <span>G</span> </div> <div class="luarbulat"></div> </div> <div class="name"><a href="http://www.pixelmimic.com/"></a> </div>' +
                                        '</div>';
                                $(over).appendTo('body');
                                $('#overlay').css('height', $('body').height());
                            }
                            function loadingHide() {
                                $('#overlay').remove();
                            }


        </script>
        @yield('js')
    </body>
</html>
