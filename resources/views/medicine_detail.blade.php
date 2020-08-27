@extends('layout.master')

@section('content')
<section class="product-detail-sec section-padding">
    <div class="container">
        <div class="row product-main-wrap">

            <div class="col-md-12 product-main-wrap-cont">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-5 col-12 product-preview">
                        <div class="product-sidebar-item">

                            <div class="preview-pic tab-content">
                                @foreach ($product->images as $key=>$val)
                                    <div class="tab-pane text-center @if($key == 0) active @endif" id="pic-{{$key}}">
                                        <a href="javascript:void(0)" class="zoom"><img src="{{ $val->img }}" alt="pro1" class="img-fluid"></a>
                                    </div>
                                @endforeach
                            </div>
                            <ul class="preview-thumbnail nav nav-tabs">
                                @foreach ($product->images as $key=>$val)
                                    <li class="@if($key == 0) active @endif">
                                        <a href="javascript:void(0)" data-target="#pic-{{$key}}" data-toggle="tab"><img src="{{ $val->img }}" alt="pro1" class="img-fluid w-100"></a>
                                    </li>
                                @endforeach
                            </ul>
                            
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-8 col-md-7 col-12 product-info-cont">
                        <span class="msg-error-o width-100p"></span>
                        <form method="post" id="product_frm">

                            <div class="product-info-inner">
                                <div class="product-title-desc">
                                    <h3 class="pro-name">
                                        <a href="#">{{ $product->brand_name }}</a>
                                    </h3>
                                </div>
                                <div class="product-prices">
                                    <span>
                                        <sup><img src="{{ asset('image/bengali-letter.png') }}" alt=""></sup>
                                        <span class="price_block"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="pro-stock-status">
                                <ul>
                                    <li class="in_stock_box">
                                        <a href="#" class="in-stock">In Stock</a>
                                    </li>
                                    <li class="out_of_stock_box">
                                        <a href="#" class="out-stock">out of stock</a>
                                    </li>

                                    @foreach ($product->inventory as $key=>$val)
                                        <li class="arrange_box" id="arrange_box_{{$key}}">
                                            <label class="checkbox-cont">
                                                <a href="#" class="arrange">Arrange for me</a>
                                                <input type="checkbox" name="arrange[{{$key}}]" id="arrange_{{$key}}">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                            <div class="packet-qty">
                                <ul>
                                    @foreach ($product->inventory as $key=>$val)
                                        <li>
                                            <div class="packet-qty-cont">
                                                <label class="cus-radio">
                                                    <span class="packet-qty-select">{{ $val->capacity }}</span>
                                                    <input type="hidden" name="capacity[{{$key}}]" id="capacity_{{$key}}" value="{{$val->capacity}}" />
                                                    <input type="radio" @if($key == 0) checked @endif name="price_radio" value="{{ $val->price }}_{{ $key }}_{{ $val->stock }}">
                                                    <span class="checkmark"></span>
                                                </label>
                                                <span class="counter-input">
                                                    <a href="#" class="minus-btn" id="minus-btn-{{$key}}-{{ $val->stock }}"><i class="ti-minus"></i></a>
                                                    <input type="text" name="qty[{{$key}}]" id="qty_{{$key}}" value="1" readonly>
                                                    <a href="#" class="plus-btn" id="plus-btn-{{$key}}-{{ $val->stock }}"><i class="ti-plus"></i></a>
                                                </span>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="product-action-button">
                                <input type="hidden" name="item_id" id="item_id" value="{{$product->_id}}" />
                                <input type="hidden" name="item_type" id="item_type" value="medicine" />
                                <a href="" class="btn btn-style3 buy-more add_to_cart_btn" id="buy_more">Buy more</a>
                                <a href="" class="btn btn-style checkout add_to_cart_btn" id="checkout">Checkout</a>
                            </div>

                        </form>
                        
                    </div>
                </div>
                <br/><br/>
            </div>

            <div class="col-12">
                <div class="description-box">
                    <h5>
                        <a href="#">Description</a>
                    </h3>
                    @php
                        $lastLetter = urldecode($product->description);
                    @endphp

                    @if(strlen($lastLetter) > 500)
                        <span>{{substr($lastLetter,0,500)}}</span>
                        <span class="read-more-show hide_content"><br/>See More ...</span>
                        <span class="read-more-content"> {{substr($lastLetter,500,strlen($lastLetter))}} 
                            <br/>
                            <span class="read-more-hide hide_content">See Less </i></span> 
                        </span>
                    @else
                        {{$lastLetter}}
                    @endif
                
                </div>
            </div>

        </div>

    </div>
</section>

<!-- @include('partials.related_product', ['related_medicines' => $product->related_medicines]) -->
@include('partials.backtotop')
@endsection

@section('footer_js')
    <script>
        // price_display();
        // $('input[type=radio][name=price_radio]').change(function() {
        //     price_display();
        // });

        // function price_display(){
        //     var price_select = $("input[name='price_radio']:checked").val();
        //     $('.price_block').html(price_select);
        // }
    </script>

    <script>
        price_display();
        $('input[type=radio][name=price_radio]').change(function() {
            price_display();
        });

        $('input[type=checkbox][name*="arrange["]').change(function() {
            price_display();
        });

        function price_display(){
            var price_select = $("input[name='price_radio']:checked").val();
            var p_arry = price_select.split('_');
            $('.price_block').html(p_arry[0]);
            // stock
            stock = parseInt(p_arry[2]);
            // stock = 0;
            // console.log(stock);
            // console.log(p_arry[1]);
            qty_val = $("#qty_"+p_arry[1]).val();
            // console.log(qty_val);

            // clickable
            $('.minus-btn').addClass('unclickable');
            $('.plus-btn').addClass('unclickable');
            
            $(".arrange_box").addClass('display-none');
            $(".related-block").addClass('display-none');
            if(stock > qty_val){
                // in stock 

                $("#arrange_"+p_arry[1]).prop("checked", false);

                $(".in_stock_box").removeClass('display-none');
                $(".out_of_stock_box").addClass('display-none');

                $('#minus-btn-'+p_arry[1]+'-'+stock).removeClass('unclickable');
                $('#plus-btn-'+p_arry[1]+'-'+stock).removeClass('unclickable');
            }else{
                // out of stock
                $(".in_stock_box").addClass('display-none');
                $(".out_of_stock_box").removeClass('display-none');
                $("#arrange_box_"+p_arry[1]).removeClass('display-none');
                $(".related-block").removeClass('display-none');

                if($("#arrange_"+p_arry[1]).prop("checked") == true){
                    // console.log('#minus-btn-'+p_arry[1]+'-'+stock);
                    $('#minus-btn-'+p_arry[1]+'-'+stock).removeClass('unclickable');
                    $('#plus-btn-'+p_arry[1]+'-'+stock).removeClass('unclickable');
                }

                $('#minus-btn-'+p_arry[1]+'-'+stock).removeClass('unclickable');

                if($("#arrange_"+p_arry[1]).prop("checked") == false){
                    // $("#qty_"+p_arry[1]).val('0');
                    $("#qty_"+p_arry[1]).val(stock);
                }
                
            }
        }

        $('.minus-btn').on('click', function(e) {
            e.preventDefault();
            var $this = $(this);
            var $thisAry = $this.attr('id').split('-');
            var $input = $("#qty_"+$thisAry[2]);
            var value = parseInt($input.val());

            if (value > 1) {
                value = value - 1;
            } else {
                value = 0;
            }
            $input.val(value);
            price_display();
        });

        $('.plus-btn').on('click', function(e) {
            e.preventDefault();
            var $this = $(this);
            var $thisAry = $this.attr('id').split('-');
            var $input = $("#qty_"+$thisAry[2]);
            var value = parseInt($input.val());

            // console.log($thisAry[2]);
            // console.log($thisAry[3]);

            // if($("#arrange_"+$thisAry[2]).prop("checked") == true){
            //     stock = 10000;
            // }else{
                stock = $thisAry[3];
            // }

            // console.log('st='+stock);
            // console.log('val='+value);

            if (value < stock) {
                // console.log('1111');
                value = value + 1;
            } else {

                if($("#arrange_"+$thisAry[2]).prop("checked") == true){
                    // alert ('y');
                    value = value + 1;
                }
                // console.log('2222');
                // value = 2;
                // alert('Product out of stock! You can choose arrange for me');
            }

            // console.log(value);
            $input.val(value);

            if($("#arrange_"+$thisAry[2]).prop("checked") == false){
                if (value == stock) {
                    alert('Product out of stock! You can choose arrange for me');
                }
            }

            price_display();
        });

        $(".add_to_cart_btn").click(function(e){
            e.preventDefault();
            callback = $(this).attr('id');
            add_to_cart(callback);
        });

        function add_to_cart(callback){
            is_zero = check_for_not_all_zero();
            if(is_zero == "Y"){
                $(".msg-error-o").html('<div class="alert alert-danger"><ul><li>Add atleast one qty more than zero</li></ul></div>').show().delay(3000).fadeOut();
                return false;
            }

            var form = $("#product_frm")[0];
            var formData = new FormData(form);
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('callback', callback);

            $.ajax({
                type:'POST',
                url:'{{ url("add_to_cart") }}',
                dataType: "json",
                cache: false,
                contentType: false,
                processData: false,
                data : formData,
                success:function(data) {
                    // console.log(data);
                    // console.log('111');
                    if(data.status){
                        if(callback == 'buy_more'){
                            window.location.href = "{{ url('/') }}";
                        }else{
                            window.location.href = "{{ url('checkout') }}";
                        }
                    }

                    // $(".msg-error-o,.msg-success-o").html('');
                    // if(data.error){
                    //     $(".msg-error-o").html('<div class="alert alert-danger"><ul><li>'+data.error+'</li></ul></div>');
                    // }
                    // if(data.success){
                    //     // $("#add_address_frm")[0].reset();
                    //     $("#edit-address").modal("hide");
                    //     $(".msg-success-o").html('<div class="alert alert-success"><ul><li>'+data.success+'</li></ul></div>').show().delay(3000).fadeOut();
                    //     load_edit_profile_block();
                    // }
                }
            });

        }

        function check_for_not_all_zero(){
            var is_zero = "Y";
            $("input[name*='qty[']").each(function(index,val) {
                radio_val = $(this).val();
                if(radio_val > 0){
                    is_zero = "N";
                }
            });
            return is_zero;
        }
    </script>

    <script type="text/javascript">
        // Hide the extra content initially, using JS so that if JS is disabled, no problemo:
        $('.read-more-content').addClass('hide_content')
        $('.read-more-show, .read-more-hide').removeClass('hide_content')

        // Set up the toggle effect:
        $('.read-more-show').on('click', function(e) {
            $(this).next('.read-more-content').removeClass('hide_content');
            $(this).addClass('hide_content');
            e.preventDefault();
        });

        // Changes contributed by @diego-rzg
        $('.read-more-hide').on('click', function(e) {
            var p = $(this).parent('.read-more-content');
            p.addClass('hide_content');
            p.prev('.read-more-show').removeClass('hide_content'); // Hide only the preceding "Read More"
            e.preventDefault();
        });
    </script>

@endsection