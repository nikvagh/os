
<form method="post" id="cart_frm">
    @if(isset($cart_data))
        @foreach($cart_data as $key=>$val)
        
            @if(!empty($val->item_data))

                @foreach($val->item_data as $key1=>$val1)

                    @if($val1->qty > 0)
                        <div class="cart-order-desc">
                            <div class="col-xl-8 col-lg-8 col-md-8 col-12 cart-order-detail">
                                <div class="cart-pro-img">
                                    <a href="#"><img src="{{ $val->item_image }}" alt="{{ $val->item_name }}" class="img-fluid"></a>
                                </div>
                                <div class="cart-p-de">
                                    <h5><a href="{{ url('product_details/'.$val->item_id) }}">{{ $val->item_name }}</a></h5>
                                    <!-- <p>{!! urldecode($val->item_desc) !!}</p> -->
                                    <p>{{ $val1->capacity }}</p>
                                    <span class="cart-p-price">
                                        <sup><img src="{{ asset('image/cart-b-letter.png') }}" alt=""></sup>
                                        {{ $val1->price }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-12 cart-order-detail">
                                <div class="cart-qty">
                                    <span class="counter-input">
                                        <a href="#" class="minus-btn" id="minus-btn-{{$val->item_id}}-{{$key1}}-{{$val->item_type}}"><i class="ti-minus"></i></a>
                                        <input type="text" name="qty[{{$val->item_id}}][{{$key1}}]" id="qty_{{$val->item_id}}_{{$key1}}" value="{{ $val1->qty }}">
                                        <a href="#" class="plus-btn" id="plus-btn-{{$val->item_id}}-{{$key1}}-{{$val->item_type}}"><i class="ti-plus"></i></a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endif

                    <input type="hidden" name="capacity[{{$val->item_id}}][{{$key1}}]" value="{{ $val1->capacity }}"/>
                    <input type="hidden" name="arrange[{{$val->item_id}}][{{$key1}}]" value="{{ $val1->arrange }}"/>
                @endforeach

            @else
                <!-- <div class="cart-order-desc">
                    <div class="col-xl-8 col-lg-8 col-md-8 col-12 cart-order-detail">
                        <div class="cart-p-de">
                            <p class="text-danger">{!! urldecode($val->item_message) !!}</p>
                        </div>
                    </div>
                </div> -->
            @endif

        @endforeach
        <div class="cart-p-t-cont">
            <div class="cart-p-total">
                <ul>
                    <li>
                        <span class="c-s-total">Sub Total</span>
                        <span><img src="{{ url('image/cart-bengali-letter.png') }}" alt="">{{$total_data->subtotal}}</span>
                    </li>
                    <li>
                        <span class="c-s-total">Delivery Fee</span>
                        <span><img src="{{ url('image/cart-bengali-letter.png') }}" alt="">{{$total_data->delivery_fee}}</span>
                    </li>
                    <li>
                        <span class="c-s-total">Discount</span>
                        <span><img src="{{ url('image/cart-bengali-letter.png') }}" alt="">{{$total_data->discount}}</span>
                    </li>
                    <li>
                        <span class="c-s-total">Total</span>
                        <span class="cart-m-total"><img src="{{ url('image/cart-bengali-letter.png') }}" alt="">{{$total_data->total}}</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="float-right mt-2">
            <a href="{{ url('checkout') }}" class="btn btn-style">Checkout</a>
        </div>

    @else
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <ul>
                <li> <i class="fa fa-exclamation-circle"></i> {{$empty_msg}} </li>
            </ul>
        </div>
    @endif
</form>
