@extends('layout.master')

@section('content')

@include('slider', ['slider' => $slider])

<section class="section-wrap otc-medicine-section">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="section-padding">
                    <div class="other-section-title">
                        <h2>
                            <span class="title2">Products</span>
                            <!-- <span class="title1">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</span> -->
                        </h2>
                    </div>
                    <div class="otc-edicine-product">
                        <div class="row otc-edicine-pro-desc">

                            @forelse ($page_data as $key=>$val)
                                <div class="col otc-edicine-pro-img page_{{$page}}">
                                    <div class="single-product">
                                        <div class="product-img">
                                            <a href="{{ url('product_details/' . $val->_id) }}">
                                                <img class="img-fluid" src="{{ $val->images[0]->img }}">
                                            </a>
                                        </div>
                                        <div class="prodyct-content">
                                            <h6><a href="{{ url('product_details/' . $val->_id) }}">{{ $val->prod_name }}</a></h6>
                                            <p>{!! urldecode($val->prod_desc) !!}</p>
                                            <span><sup>৳</sup>{{$val->inventory[0]->price}}</span>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="section-padding">
                                    <div class="other-section-title">

                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <ul>
                                                <li> <i class="fa fa-exclamation-circle"></i> No medicines found</b></li>
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            @endforelse
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<span id="load_more"></span>

{{-- @include('partials.pagination_link', ['total_record' => 4,'per_page' => (config('constants.product_per_page')), 'curr_page' => $curr_page, 'link_root' => 'product/list/'.$cat_id .'/']) --}}

@include('partials.recomanded')
@include('partials.order_from_phone')
@include('partials.backtotop')

@endsection

@section('footer_js')
    <script>
        var promise;
        var load = "Y";
        var last_page_class_num = 0;
        var load_more = "Y";

        $(window).scroll(function(){
            $.when(promise).then(function(){
                var top_window2 = $(window).scrollTop();
                var bottom_window2 = top_window2 + $(window).height();                      
                var top_statistiche = $('#load_more').offset().top;  
                if(((top_statistiche >= top_window2) && (top_statistiche <= bottom_window2))){  
                    animation_somedivs();
                }
            });
        });

        function animation_somedivs(){
            if(load == "Y"){
                if(load_more == 'Y'){
                    // last_page_class_num = $('.otc-edicine-pro-desc > .col').attr('class').split(' ').pop().split('_').pop();
                    last_el = $('.page_'+last_page_class_num+':last');
                    // console.log('.page_'+last_page_class_num+':last');
                    page = parseInt(last_page_class_num)+1;
                    load = "N";
                    promise = $.ajax({
                        type:'GET',
                        url:'/load_more_product/{{$cat_id}}/'+page,
                        success:function(data) {
                            // console.log(data);
                            // return false;
                            if(data != ""){
                                last_el.after(data);
                                load = "Y";
                                last_page_class_num++;
                            }else{
                                load_more = "N";
                            }
                        }
                    });
                }
            }
        }
    </script>
@endsection