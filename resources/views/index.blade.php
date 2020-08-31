
@extends('layout.master')

@section('content')

@include('slider', ['slider' => $slider])

<!-- <section class="section-wrap">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="section-padding">
                    <div class="medicine">
                        <div class="section-content">
                            <div class="section-title">
                                <h2>
                                    <span class="title1">OTC</span>
                                    <span class="title2">Medicine</span>
                                </h2>
                                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                                <a href="javascript:void(0)" class="btn btn-style2">
                                    <span>See all</span>
                                    <i class="fas fa-caret-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="section-product">
                            <div class="owl-carousel owl-theme medicine-slider" id="medicine-slider">
                                <div class="item">
                                    <div class="single-product">
                                        <div class="product-img">
                                            <a href="product-detail.html">
                                                <img class="img-fluid" src="image/test.png">
                                            </a>
                                        </div>
                                        <div class="prodyct-content">
                                            <h6><a href="product-detail.html">Elements-LIV-s Gain</a></h6>
                                            <p>For sluggish liver and infective</p>
                                            <span><sup><img src="{{ asset('image/home-bengali-letter.png') }}" alt=""></sup>250</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="single-product">
                                        <div class="product-img">
                                            <a href="product-detail.html">
                                                <img class="img-fluid" src="image/test.png">
                                            </a>
                                        </div>
                                        <div class="prodyct-content">
                                            <h6><a href="product-detail.html">Elements-LIV-s Gain</a></h6>
                                            <p>For sluggish liver and infective</p>
                                            <span><sup><img src="{{ asset('image/home-bengali-letter.png') }}" alt=""></sup>250</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="single-product">
                                        <div class="product-img">
                                            <a href="product-detail.html">
                                                <img class="img-fluid" src="image/test.png">
                                            </a>
                                        </div>
                                        <div class="prodyct-content">
                                            <h6><a href="product-detail.html">Elements-LIV-s Gain</a></h6>
                                            <p>For sluggish liver and infective</p>
                                            <span><sup><img src="{{ asset('image/home-bengali-letter.png') }}" alt=""></sup>250</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="single-product">
                                        <div class="product-img">
                                            <a href="product-detail.html">
                                                <img class="img-fluid" src="image/test.png">
                                            </a>
                                        </div>
                                        <div class="prodyct-content">
                                            <h6><a href="product-detail.html">Elements-LIV-s Gain</a></h6>
                                            <p>For sluggish liver and infective</p>
                                            <span><sup><img src="{{ asset('image/home-bengali-letter.png') }}" alt=""></sup>250</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="single-product">
                                        <div class="product-img">
                                            <a href="product-detail.html">
                                                <img class="img-fluid" src="image/test.png">
                                            </a>
                                        </div>
                                        <div class="prodyct-content">
                                            <h6><a href="product-detail.html">Elements-LIV-s Gain</a></h6>
                                            <p>For sluggish liver and infective</p>
                                            <span><sup><img src="{{ asset('image/home-bengali-letter.png') }}" alt=""></sup>250</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->

@php
    $count_lp = 1
@endphp

@foreach ($home_data as $key=>$val)

    @if(!empty($val->category_data)) 

        @if ($val->cat_type != "doctors")

            <section class="section-wrap">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="section-padding @if($loop->iteration != 1) section-border @endif">
                                <div class="medicine @if($count_lp % 2 == 0) section-reverse @endif">

                                    @if($val->cat_type == "disease")
                                        <div class="section-content">
                                            <div class="section-title">
                                                <h2>
                                                    <span class="title1">{{ $val->cat_name }}</span>
                                                    <!-- <span class="title2">Equipment</span> -->
                                                </h2>
                                                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                                                <a href="{{ url('disease/list/1') }}" class="btn btn-style2">
                                                    <span>See all</span>
                                                    <i class="fas fa-caret-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="section-product">
                                            <div class="owl-carousel owl-theme medicine-slider section-home-{{ $count_lp % 2 === 0 ? 'left' : 'right' }}" id="equipment-slider-{{$count_lp}}">
                                                @foreach ($val->category_data as $key1=>$val1)
                                                    @if($val1->in_home_screen == 1)
                                                        <div class="item">
                                                            <div class="single-product">
                                                                <div class="product-img">
                                                                    <a href="{{ url('disease_details/'.$val1->_id) }}">
                                                                        <img class="img-fluid" src="{{ $val1->dis_image }}">
                                                                    </a>
                                                                </div>
                                                                <div class="prodyct-content">
                                                                    <h6><a href="">{{$val1->dis_name}}</a></h6>
                                                                    <p>{{$val1->dis_desc}}</p>
                                                                    <!-- <span><sup><img src="{{ asset('image/home-bengali-letter.png') }}" alt=""></sup>250</span> -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>

                                        @php
                                            $count_lp++;
                                        @endphp

                                    @endif

                                    @if($val->cat_type == "prescribed")
                                        <div class="section-content">
                                            <div class="section-title">
                                                <h2>
                                                    <span class="title1">{{ $val->cat_name }}</span>
                                                    <!-- <span class="title2">Equipment</span> -->
                                                </h2>
                                                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                                                <a href="{{ url('medicine/list/1') }}" class="btn btn-style2">
                                                    <span>See all</span>
                                                    <i class="fas fa-caret-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="section-product">
                                            <div class="owl-carousel owl-theme medicine-slider section-home-{{ $count_lp % 2 === 0 ? 'left' : 'right' }}" id="equipment-slider-{{$count_lp}}">
                                                @foreach ($val->category_data as $key1=>$val1)
                                                    @if($val1->in_home_screen == 1)
                                                        <div class="item">
                                                            <div class="single-product">
                                                                <div class="product-img">
                                                                    <a href="{{ url('medicine_details/' . $val1->_id) }}">
                                                                        @if(!empty($val1->images))
                                                                            <img class="img-fluid" src="{{$val1->images[0]->img}}">
                                                                        @endif
                                                                    </a>
                                                                </div>
                                                                <div class="prodyct-content">
                                                                    <h6><a href="{{ url('medicine_details/' . $val1->_id) }}">{{$val1->brand_name}}</a></h6>
                                                                    <p>{!! urldecode($val1->description) !!}</p>
                                                                    <span><sup><img src="{{ asset('image/home-bengali-letter.png') }}" alt=""></sup>{{$val1->inventory[0]->price}}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                                
                                            </div>
                                        </div>
                                        @php
                                            $count_lp++;
                                        @endphp
                                    @endif

                                    @if($val->cat_type == "products")
                                        <div class="section-content">
                                            <div class="section-title">
                                                <h2>
                                                    <span class="title1">{{ $val->cat_name }}</span>
                                                    <!-- <span class="title2">Equipment</span> -->
                                                </h2>
                                                <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                                                <a href="{{ url('product/list/'.$val->category_data[0]->cat_id.'/1') }}" class="btn btn-style2">
                                                    <span>See all</span>
                                                    <i class="fas fa-caret-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="section-product">
                                            <div class="owl-carousel owl-theme medicine-slider section-home-{{ $count_lp % 2 === 0 ? 'left' : 'right' }}" id="equipment-slider-{{$count_lp}}">
                                                @foreach ($val->category_data as $key1=>$val1)
                                                    @if($val1->in_home_screen == 1)
                                                        <div class="item">
                                                            <div class="single-product">
                                                                <div class="product-img">
                                                                    <!-- <a href="/product_details/{{$val1->_id}}"> -->
                                                                    <a href="{{ url('product_details/' . $val1->_id) }}">
                                                                    
                                                                        <img class="img-fluid" src="{{$val1->images[0]->img}}">
                                                                    </a>
                                                                </div>
                                                                <div class="prodyct-content">
                                                                    <h6><a href="product-detail.html">{{$val1->prod_name}}</a></h6>
                                                                    <p>{!! urldecode($val1->prod_desc) !!}</p>
                                                                    <span><sup><img src="{{ asset('image/home-bengali-letter.png') }}" alt=""></sup>{{$val1->inventory[0]->price}}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                                
                                            </div>
                                        </div>
                                        @php
                                            $count_lp++;
                                        @endphp
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        @else
        
            <section class="section-wrap">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="section-padding section-border">
                                <div class="other-section-title">
                                    <h2>
                                        <span class="title1">Online</span>
                                        <span class="title2">Doctors</span>
                                    </h2>
                                </div>
                                
                                <div class="owl-carousel owl-theme team-testimonial" id="team-testimonial">
                                    @foreach ($val->category_data as $key1=>$val1)
                                        {{-- @if($val1->in_home_screen == 1) --}}
                                            <div class="item">
                                                <div class="doctor-team">
                                                    <a href="{{ url('doctor_details/'.$val1->_id) }}">
                                                        <img class="img-fluid" src="{{$val1->doc_image}}">
                                                    </a>
                                                    <h6>{{$val1->doc_name}}</h6>
                                                    <p>{{$val1->doc_designation}}</p>
                                                </div>
                                            </div>
                                        {{-- @endif --}}
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif

    @endif

@endforeach


<!-- <section class="section-wrap">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="section-padding section-border">
                    <div class="other-section-title">
                        <h2>
                            <span class="title1">Top</span>
                            <span class="title2">Offers</span>
                        </h2>
                    </div>
                    <div class="owl-carousel owl-theme banner-slider" id="banner-slider">
                        <div class="item">
                            <div class="product-banner">
                                <a href="javascript:void(0)">
                                    <img class="img-fluid" src="image/banner.jpg">
                                </a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="product-banner">
                                <a href="javascript:void(0)">
                                    <img class="img-fluid" src="image/banner.jpg">
                                </a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="product-banner">
                                <a href="javascript:void(0)">
                                    <img class="img-fluid" src="image/banner.jpg">
                                </a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="product-banner">
                                <a href="javascript:void(0)">
                                    <img class="img-fluid" src="image/banner.jpg">
                                </a>
                            </div>
                        </div>
                        <div class="item">
                            <div class="product-banner">
                                <a href="javascript:void(0)">
                                    <img class="img-fluid" src="image/banner.jpg">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->

<!-- <section class="section-wrap">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="section-padding section-border">
                    <ul class="banner-brand">
                        <li class="product-banner">
                            <a href="javascript:void(0)">
                                <img class="img-fluid" src="image/ads.jpg">
                            </a>
                        </li>
                        <li class="product-banner">
                            <a href="javascript:void(0)">
                                <img class="img-fluid" src="image/ads.jpg">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section> -->

@include('partials.order_from_phone')


<div class="add-new-address-modal" id="popup-box">
</div>

@include('partials.backtotop')
@endsection



@section('footer_js')
    @if(Session::get('user')->show_bonus == 1)
        <script>
            $(document).ready(function(){
                load_block_popup();
            });

            function load_block_popup(){
                $.ajax({
                    type:'GET',
                    url:'/popup_first_time',
                    success:function(data) {
                        // console.log(data);
                        // $(".msg-error,.msg-success").html('');
                        $("#popup-box").html(data);
                        $("#popup-modal").modal('show');
                    }
                });
            }


        </script>
    @endif
@endsection
