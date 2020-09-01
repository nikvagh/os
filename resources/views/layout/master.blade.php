<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- title -->
        <title>osudpotro</title>
        <meta name="description" content=""/>
        <meta name="keywords" content=""/>
        <meta name="author" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- favicon -->
        <link rel="shortcut icon" type="image/favicon" href="#">
        <!-- bootstrap -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
        <!-- animation -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/animate.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/aos.css') }}">
        <!-- owl slider -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/swiper.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/owl.carousel.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/owl.theme.default.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/thumbnail-slider.css') }}">
        <!-- font awesome -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/all.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/themify-icons.css') }}">
        <!-- style -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
    </head>
    <body>

        <div class="top-header">
            <div class="container">
                <div class="row">
                    <div class="col top-header-cont">
                        <div class="main-logo">
                            <a href="{{ url('/') }}" class=""><img src="{{ asset('image/logo1.png') }}" alt="logo"></a>
                        </div>
                    </div>
                    <div class="col top-header-cont">
                        <div class="search-input">
                            <form method="post" class="search_form" action="search_p">
                                <span class="search-input-box">
                                    <a href="#" class="search-icon"><i class="fas fa-search"></i></a>
                                    {{csrf_field()}}
                                    <input type="text" name="needle" id="search_header_s" placeholder="Search Medicine" value="@isset($needle){{ $needle }}@endisset" autocomplete="off">
                                </span>
                            </form>
                            <div class="search-result">
                            </div>
                        </div>
                        <div class="top-main-info">
                            <ul>
                                <li>
                                    <div class="main-info">
                                        <a href="javascript:void(0)" id="location-header">
                                            <img class="img-fluid" src="{{ asset('image/top-location.png') }}">
                                        </a>
                                        <div class="main-info-text">
                                            <span>Deliver to </span>
                                            <span class="header-deliver" style=""> <span class="header-name">{{ Session::get('user')->name }}</span> <span>- Dhaka </span></span> 
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="main-info">
                                        <a href="javascript:void(0)">
                                            <img class="img-fluid" src="{{ asset('image/top-track.png') }}">
                                        </a>
                                        <div class="main-info-text">
                                            <span>Track </span>
                                            <span>Your Order</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="main-info">
                                        <a href="{{ url('cart') }}" class="cart_header_box">
                                            <img class="img-fluid" src="{{ asset('image/top-basket.png') }}">
                                            <!-- <span class="badge badge-success cart_badge">9</span> -->
                                        </a>
                                        <div class="main-info-text">
                                            <span class="info-text-cart">Cart</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col top-header-cont">
                        <div class="login-profile">
                            <div class="profile-info">
                                <div class="profile-info-text">
                                    <p>Hello,</p>
                                    <span class="header-name">{{ Session::get('user')->name }}</span>
                                </div>
                                <div class="profile-info-img header-profile-pic">
                                    <a href="#">
                                        @if(Session::get('user')->image != '')  
                                            <img class="header-profile-img" src="{{ Session::get('user')->image }}" alt="">
                                        @else
                                            <img class="header-profile-img" src="{{ asset('image/group-4.png') }}" alt="group-4">
                                        @endif
                                    </a>
                                </div>
                                <div class="profile-dropdown">
                                    <ul>
                                        <li>
                                            <a href="{{ url('profile') }}">
                                                <img src="{{ asset('image/profile-account.png') }}" alt="profile-account">
                                                <span>profile</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ url('setting') }}">
                                                <img src="{{ asset('image/settings.png') }}" alt="settings">
                                                <span>settings</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="news-feed.html">
                                                <img src="{{ asset('image/article.png') }}" alt="article">
                                                <span>news feed</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/logout">
                                                <img src="{{ asset('image/logout.png') }}" alt="logout">
                                                <span>logout</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="language-op">
                            <label class="switch">
                                <input type="checkbox" @if(Session::get('user')->language == 'en') checked @endif name="language" id="language">
                                <span class="slider round">
                                    <span class="eng-lag @if(Session::get('user')->language == 'en') active @endif">EN</span>
                                    <span class="bangali-lan @if(Session::get('user')->language == 'bn') active @endif"> বাংলা</span>
                                </span>
                            </label>
                        </div>
                    </div>
                </div>                      
            </div>  
        </div>
        <header class="head">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-12 main-header">
                        <nav class="navbar navbar-expand-lg main-menu">
                            <button class="navbar-toggler" type="button">
                                <span class="line"></span>
                            </button>
                            <div class="search-input responsive-search">
                                <span class="search-input-box">
                                    <a href="#" class="search-icon"><i class="fas fa-search"></i></a>
                                    <input type="text" name="needle" id="search_header_b" placeholder="Search Medicine" autocomplete="off">
                                </span>
                            </div>
                            <div class="navbar-collapse" id="navbar">
                                <ul class="navbar-nav" id="collapse-parent">
                                    <li class="nav-item">
                                        <a class="nav-title" href="{{ url('disease/list/1') }}">
                                            <span>{{ __('messages.OTC_Medicine') }}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-title" href="{{ url('medicine/list/1') }}">
                                            <span>{{ __('messages.Prescription_Medicine') }}</span>
                                        </a>
                                    </li>
                                    
                                    @php
                                        $menus = get_header();
                                        //print_r($menus);
                                    @endphp

                                    @foreach ($menus as $val)
                                        <li class="nav-item">
                                            <a class="nav-title" href="{{ url('product/list') }}/{{ $val['cat_id'] }}/1">
                                                <span>{{ $val['name'] }}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                    
                                    <!-- <li class="nav-item">
                                        <a class="nav-title" href="{{ url('product/list/5f32b1ad61563518bc497dfb/1') }}">
                                            <span>{{ __('messages.Medical_Equipment') }}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-title" href="{{ url('product/list/5f32b1f361563518bc497dfc/1') }}">
                                            <span>{{ __('messages.Female_Products') }}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-title" href="{{ url('product/list/5f32b25d61563518bc497dfe/1') }}">
                                            <span>{{ __('messages.Baby_Products') }}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-title" href="{{ url('product/list/5f32b15c61563518bc497dfa/1') }}">
                                            <span>{{ __('messages.Mens_Products') }}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-title" href="{{ url('product/list/5f32b22961563518bc497dfd/1') }}">
                                            <span>{{ __('messages.Disinfectant_Medicine') }}</span>
                                        </a>
                                    </li> -->

                                    <li class="nav-item">
                                        <a class="nav-title" href="{{ url('doctor_list') }}">
                                            <span>{{ __('messages.Online_Doctors') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </header>

        @yield('content')
        
        <section class="footer-top-area">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="footer-list-wrap">
                            <ul class="footer-list">
                                <li class="ftlink-li">
                                    <h2 class="ft-title logo">About OsudPotro</h2>
                                    <p>Claritas processus dynamicus sequitu consution claritas process</p>
                                    <div class="footer-social">
                                        <ul class="social-icon">
                                            <li class="facebook">
                                                <a href="javascript:void(0)">
                                                    <img src="{{ asset('image/facebook.png') }}" alt="">
                                                </a>
                                                <a href="javascript:void(0)">
                                                    <img src="{{ asset('image/instagram.png') }}" alt="">
                                                </a>
                                                <a href="javascript:void(0)">
                                                    <img src="{{ asset('image/twitter.png') }}" alt="">
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="ftlink-li">
                                    <h2 class="ft-title">Products</h2>
                                    <a data-toggle="collapse" href="#collapse-1" class="ft-title">
                                        <span>Products</span>
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="footer-sublist collapse" id="collapse-1">
                                        <li class="ftsublink-li">
                                            <a href="javascript:void(0)" class="ft-sublink">Prices drop</a>
                                            <a href="javascript:void(0)" class="ft-sublink">New products</a>
                                            <a href="javascript:void(0)" class="ft-sublink">Best Sales</a>
                                            <a href="javascript:void(0)" class="ft-sublink">Stores</a>
                                            <a href="javascript:void(0)" class="ft-sublink">Login</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="ftlink-li">
                                    <h2 class="ft-title">Our Company</h2>
                                    <a data-toggle="collapse" href="#collapse-2" class="ft-title">
                                        <span>Our Company</span>
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="footer-sublist collapse" id="collapse-2">
                                        <li class="ftsublink-li">
                                            <a href="javascript:void(0)" class="ft-sublink">Delivery</a>
                                            <a href="javascript:void(0)" class="ft-sublink">Legal notice</a>
                                            <a href="javascript:void(0)" class="ft-sublink">About us</a>
                                            <a href="javascript:void(0)" class="ft-sublink">Secure payment</a>
                                            <a href="{{ url('contact_us') }}" class="ft-sublink">Contact us</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="ftlink-li">
                                    <h2 class="ft-title">Your Account</h2>
                                    <a data-toggle="collapse" href="#collapse-3" class="ft-title">
                                        <span>Your Account</span>
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="footer-sublist collapse" id="collapse-3">
                                        <li class="ftsublink-li">
                                            <a href="{{ url('profile') }}" class="ft-sublink">Personal info</a>
                                            <a href="{{ url('profile/order_history') }}" class="ft-sublink">Orders</a>
                                            <a href="javascript:void(0)" class="ft-sublink">Credit slips</a>
                                            <a href="javascript:void(0)" class="ft-sublink">Addresses</a>
                                            <a href="javascript:void(0)" class="ft-sublink">My wishlists</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <footer class="footer-bottom-area">
          <div class="container">
            <div class="row">
              <div class="col">
                <div class="copy-right">
                    <p>
                        <span>Copyright</span>
                        <i class="far fa-copyright"></i>
                        <span>2010-2020 OsudPotro.</span>
                        <span>All rights reserved.</span>
                    </p>
                </div>
              </div>
            </div>
          </div>
        </footer>
        <!-- footer end -->
        <!-- javascript/jquery files -->
        <!-- jquery -->
        <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
        <!-- instagramFeed -->
        <script src="{{ asset('js/jquery.instagramFeed.min.js') }}"></script>
        <!-- popper js -->
        <script src="{{ asset('js/popper.min.js') }}"></script>
        <!-- bootstrap -->
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <!-- aos -->
        <script src="{{ asset('js/aos.js') }}"></script>
        <!-- swiper -->
        <script src="{{ asset('js/swiper.min.js') }}"></script>
        <!-- masonary -->
        <script src="{{ asset('js/isotope.pkgd.min.js') }}"></script>
        <script src="{{ asset('js/imagesloaded.pkgd.min.js') }}"></script>
        <script src="{{ asset('js/masonry.pkgd.min.js') }}"></script>
        <!-- owl carousal -->
        <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
        <!-- product-zoom -->
        <script src="{{ asset('js/jquery.zoom.js') }}"></script>
        <!-- custom -->
        <script src="{{ asset('js/custom.js') }}"></script>

        @yield('footer_js')

        <script>
            $(document).ready(function(){
                // load_language_btn();
            });

            $("#language").change(function() {
                if($(this).is(':checked')){
                    language = 'en';
                }else{
                    language = 'bn';
                }

                $.ajax({
                    type:'POST',
                    url:'/change_language',
                    dataType: "json",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "language": language
                    },
                    success:function(data) {
                        if(data.language){
                            // console.log('111');
                            window.location.replace('{{ url("locale") }}/'+data.language);
                        }
                    }
                });
            }); 

            // $('input[name=needle]').focusout(function(e) {
            //     $(".search-result").css('display:none');
            // });
            // keypress
            $('input[name=needle]').on("keyup focus", function(e) {
                search_val = $(this).val();
                if (e.keyCode == 13) {
                    // alert(search_val);
                    var form = $(this).parents('form:first');
                    if(search_val != ""){
                        // form.attr('action', "search_p/"+search_val);
                        // search_url = 'search_p/'+search_val;
                        // console.log(search_val);
                        form.attr('action', "{{ url('/search_p') }}/"+search_val);
                        // alert('111');
                    }else{
                        form.removeAttr('action');
                        // alert('222');
                    }
                }
                // if(search_val != ""){
                    var form = $(this).parents('form:first');
                    form.attr('action', "{{ url('/search_p') }}/"+search_val);

                    $.ajax({
                        type:'GET',
                        url:"{{ url('/ajax_search') }}/"+search_val,
                        dataType: "json",
                        success:function(data) {
                            // console.log(data);

                            if(data.re){
                                window.location.href = "{{ url('') }}/"+data.re;
                            }
                            $(".search-result").html(data.view_data);
                            $(".search-result").css('opacity','1');
                        }
                    });
                // }

            });

            $(document).on("blur",".search-input",function(){
                // $(".search-result").html('');
                // $(".search-result").css('opacity','0');
            });

            $(".search_form").on("submit", function(e){
                // alert('ddd');
                // e.preventDefault();
                search_val = $('input[name=needle]').val();
                if(search_val != ""){
                    // $(this).attr('action', "search_post/"+search_val).submit();
                }else{
                    return false;
                }
            });

            // function load_language_btn(){
            //     $.ajax({
            //         type:'GET',
            //         url:'/popup_first_time',
            //         success:function(data) {
            //             // console.log(data);
            //             // $(".msg-error,.msg-success").html('');
            //             $("#popup-box").html(data);
            //             $("#popup-modal").modal('show');
            //         }
            //     });
            // }
            
        </script>

        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script> 
        <script type="text/javascript">

            // $("#location-header").click(function(){
            //     // initialize();
            // });

            // var geocoder;

            // if (navigator.geolocation) {
            //     navigator.geolocation.getCurrentPosition(successFunction, errorFunction);
            // } 
            // //Get the latitude and the longitude;
            // function successFunction(position) {
            //     var lat = position.coords.latitude;
            //     var lng = position.coords.longitude;
            //     codeLatLng(lat, lng)
            // }

            // function errorFunction(){
            //     alert("Geocoder failed");
            // }

            // function initialize() {
            //     geocoder = new google.maps.Geocoder();
            // }

            // function codeLatLng(lat, lng) {
            //     var latlng = new google.maps.LatLng(lat, lng);
            //     geocoder.geocode({'latLng': latlng}, function(results, status) {
            //     if (status == google.maps.GeocoderStatus.OK) {
            //     console.log(results)
            //         if (results[1]) {
            //         //formatted address
            //         alert(results[0].formatted_address)
            //         //find country name
            //             for (var i=0; i<results[0].address_components.length; i++) {
            //             for (var b=0;b<results[0].address_components[i].types.length;b++) {

            //             //there are different types that might hold a city admin_area_lvl_1 usually does in come cases looking for sublocality type will be more appropriate
            //                 if (results[0].address_components[i].types[b] == "administrative_area_level_1") {
            //                     //this is the object you are looking for
            //                     city= results[0].address_components[i];
            //                     break;
            //                 }
            //             }
            //         }
            //         //city data
            //         alert(city.short_name + " " + city.long_name)


            //         } else {
            //         alert("No results found");
            //         }
            //     } else {
            //         alert("Geocoder failed due to: " + status);
            //     }
            //     });
            // }
        </script>

    </body>
</html>