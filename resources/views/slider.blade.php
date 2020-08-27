@if (!empty($slider))
    <section class="slider-section">
        <div class="owl-carousel owl-theme main-slider" id="main-slider">
            @foreach ($slider as $key=>$val)
                <div class="item">
                    <div class="slider-bg" style="background-image: url({{$val->img}});"></div>
                </div>
            @endforeach
        </div>
    </section>
    <section class="our-service-area">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                    <ul class="single-service">
                        <li class="ser-box">
                            <div class="ser-block">
                                <a href="javascript:void(0)">
                                    <img class="img-fluid" src="{{ asset('image/support.png') }}">
                                    <img class="img-fluid img2" src="{{ asset('image/support-overlay.png') }}">
                                </a>
                                <div class="service-text">
                                    <h6>Quality Support</h6>
                                    <p>Free Support Online 24/7</p>
                                </div>
                            </div>
                        </li>
                        <li class="ser-box">
                            <div class="ser-block">
                                <a href="javascript:void(0)">
                                    <img class="img-fluid" src="{{ asset('image/shield.png') }}">
                                    <img class="img-fluid img2" src="{{ asset('image/shield-overlay.png') }}">
                                </a>
                                <div class="service-text">
                                    <h6>Safe Shopping</h6>
                                    <p>Ensure Genuine 100%</p>
                                </div>
                            </div>
                        </li>
                        <li class="ser-box">
                            <div class="ser-block">
                                <a href="javascript:void(0)">
                                    <img class="img-fluid" src="{{ asset('image/support.png') }}">
                                    <img class="img-fluid img2" src="{{ asset('image/support-overlay.png') }}">
                                </a>
                                <div class="service-text">
                                    <h6>Quality Support</h6>
                                    <p>Free Support Online 24/7</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endif