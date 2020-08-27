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

        <section class="login-section">
            <div class="container-fluid">
                <div class="row">

                    <div class="col comp-logo-cont">
                        <div class="comp-logo">
                            <a href="#" class=""> <img src="{{ asset('image/logo.png') }}" alt="logo"></a>
                        </div>
                    </div>

                    <div class="col login-cont-wrap">
                        @yield('content')
                        
                        <div class="terms-conditions-bottom">
                            <span>By proceeding you agree to our</span>
                            <a href="#">Terms and Conditions</a>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <script>
          function getCodeBoxElement(index) {
            return document.getElementById('codeBox' + index);
          }
          function onKeyUpEvent(index, event) {
            const eventCode = event.which || event.keyCode;
            if (getCodeBoxElement(index).value.length === 1) {
              if (index !== 5) {
                getCodeBoxElement(index+ 1).focus();
              } else {
                getCodeBoxElement(index).blur();
                // Submit code
                console.log('submit code ');
              }
            }
            if (eventCode === 8 && index !== 1) {
              getCodeBoxElement(index - 1).focus();
            }
          }
          function onFocusEvent(index) {
            for (item = 1; item < index; item++) {
              const currentElement = getCodeBoxElement(item);
              if (!currentElement.value) {
                  currentElement.focus();
                  break;
              }
            }
          }
        </script>
        
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
    </body>
</html>