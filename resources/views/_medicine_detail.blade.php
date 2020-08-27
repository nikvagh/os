@extends('layout.master')

@section('content')
<section class="product-detail-sec">
    <div class="container">
        <div class="row product-main-wrap">

            <div class="col-md-12 product-main-wrap-cont">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-5 col-12 product-preview">
                        <div class="product-sidebar-item">
                            <!-- product main image start -->
                            <div class="preview-pic tab-content">
                                @foreach ($product->images as $key=>$val)
                                    <div class="tab-pane text-center @if($key == 0) active @endif" id="pic-{{$key}}">
                                        <a href="javascript:void(0)" class="zoom"><img src="{{ $val->img }}" alt="pro1" class="img-fluid"></a>
                                    </div>
                                @endforeach
                            </div>
                            <!-- product main image end -->
                            <!-- product below image start -->
                            <ul class="preview-thumbnail nav nav-tabs">
                                @foreach ($product->images as $key=>$val)
                                    <li class="@if($key == 0) active @endif">
                                        <a href="javascript:void(0)" data-target="#pic-{{$key}}" data-toggle="tab"><img src="{{ $val->img }}" alt="pro1" class="img-fluid w-100"></a>
                                    </li>
                                @endforeach
                            </ul>
                            <!-- product below image end -->
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-8 col-md-7 col-12 product-info-cont">
                        <form method="post" id="product_frm">
                            <div class="product-info-inner">
                                <div class="product-title-desc">
                                    <h3>
                                        <a href="#">{{ $product->generic_name }}</a>
                                    </h3>
                                    <p>
                                        {!! urldecode($product->description) !!}
                                    </p>
                                </div>
                                <div class="product-prices">
                                    <span>
                                        <sup><img src="{{ asset('image/bengali-letter.png') }}" alt="{{$product->_id}}"></sup>
                                        <span class="price_block"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="pro-stock-status">
                                <ul>

                                    @if($product->inventory[0]->stock > 0)
                                        <li>
                                            <a href="#" class="in-stock">In Stock</a>
                                        </li>   
                                    @else
                                        <li>
                                            <a href="#" class="out-stock">out of stock</a>
                                        </li>
                                        <li>
                                            <label class="checkbox-cont">
                                                <a href="#" class="arrange">Arrange for me</a>
                                                <input type="checkbox" checked="checked" name="arrange">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    @endif

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
                                                    <input type="radio" @if($key == 0) checked @endif name="price_radio" value="{{ $val->price }}_{{ $key }}">
                                                    <span class="checkmark"></span>
                                                </label>
                                                <span class="counter-input">
                                                    <a href="#" class="minus-btn" id="minus-btn-{{$key}}"><i class="ti-minus"></i></a>
                                                    <input type="text" name="qty[{{$key}}]" id="qty_{{$key}}" value="1">
                                                    <a href="#" class="plus-btn" id="plus-btn-{{$key}}"><i class="ti-plus"></i></a>
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

        </div>

    </div>
</section>
@include('partials.backtotop')
@endsection

@section('footer_js')
    <script>
        price_display();
        $('input[type=radio][name=price_radio]').change(function() {
            price_display();
        });

        function price_display(){
            var price_select = $("input[name='price_radio']:checked").val();
            var p_arry = price_select.split('_');
            $('.price_block').html(p_arry[0]);
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
                value = 1;
            }
            $input.val(value);
        });

        $('.plus-btn').on('click', function(e) {
            e.preventDefault();
            var $this = $(this);
            var $thisAry = $this.attr('id').split('-');
            var $input = $("#qty_"+$thisAry[2]);
            var value = parseInt($input.val());

            if (value < 100) {
                value = value + 1;
            } else {
                value = 2;
            }
            $input.val(value);
        });

        $(".add_to_cart_btn").click(function(e){
            e.preventDefault();
            callback = $(this).attr('id');
            add_to_cart(callback);
        });

        function add_to_cart(callback){

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
    </script>
@endsection