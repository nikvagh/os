@extends('layout.master')

@section('content')

<section class="check-out-section">
    <div class="container">
        <div class="row">

            @if (Session::has('message_s'))
                @include('partials.alert', ['type' => "success",'message'=> Session::get('message_s') ])
            @endif

            @if (Session::has('message_e'))
                @include('partials.alert', ['type' => "danger",'message'=> Session::get('message_e') ])
            @endif
            
            <span class="msg-success-o width-100p"></span>
            <span class="msg-error-o width-100p"></span>

            <div class="col check-out-wrap">
                <div class="check-out-desc">
                    <div class="check-out-title">
                        <span>Checkout</span>
                        <h3>Payment</h3>
                    </div>
                    
                    <div id="address_box"></div>
                </div>

                <!-- <div class="add-new-address-modal">
                    <div class="modal fade" id="add-new-address">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Add New Address</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="new-addr-form">
                                        <form>
                                            <div class="new-addr-form-input">
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input type="text" placeholder="Name">
                                                </div>
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <input type="text" placeholder="">
                                                </div>
                                            </div>
                                            <div class="address-select">
                                                <label class="checkbox-cont">
                                                    <a href="#" class="arrange">Use this address as a Primary address</a>
                                                    <input type="checkbox">
                                                    <span class="checkmark"></span>
                                                </label>
                                                <label class="checkbox-cont">
                                                    <a href="#" class="arrange">Use this address as a Other delivery address</a>
                                                    <input type="checkbox" checked="checked">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="new-addr-form-input-b">
                                                <div class="new-addr-form-input">
                                                    <div class="form-group">
                                                        <label>Area</label>
                                                        <input type="text" placeholder="Area">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Contact Number</label>
                                                        <input type="tel" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="new-addr-form-input">
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="email" placeholder="Email">
                                                        <a href="#" class="invoice-email">
                                                            <img src="image/invoice-info.png">Your invoice will be send to your email
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="#" class="btn btn-style">Save</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                
                <div class="add-new-address-modal">
                    <div class="modal fade" id="add-new-address">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Add New Address</h4>
                                </div>
                                <!-- Modal body -->
                                <div class="modal-body">
                                    <!-- <span class="msg-success width-100p"></span> -->
                                    <span class="msg-error width-100p"></span>

                                    <div class="new-addr-form">
                                        <form id="add_address_frm" method="post">
                                            <div class="new-addr-form-input">
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input type="text" name="name" id="name" placeholder="Name">
                                                </div>
                                                <div class="form-group">
                                                    <label>Address</label>
                                                    <input type="text" name="address" id="address" placeholder="">
                                                </div>
                                            </div>
                                            <div class="address-select">
                                                <label class="checkbox-cont">
                                                    <a href="#" class="arrange">Use this address as a Primary address</a>
                                                    <input type="radio" name="is_primary" id="is_primary">
                                                    <span class="checkmark"></span>
                                                </label>
                                                <label class="checkbox-cont">
                                                    <a href="#" class="arrange">Use this address as a Other delivery address</a>
                                                    <input type="radio" name="is_primary" checked="checked">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <br/>
                                            <div class="new-addr-form-input-b">
                                                <div class="new-addr-form-input">
                                                    <div class="form-group">
                                                        <label>House No./Flat No.</label>
                                                        <input type="text" name="address2" id="address2" placeholder="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Contact Number</label>
                                                        <input type="tel" name="contact" id="contact" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="new-addr-form-input">
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="email" name="email" id="email" placeholder="Email">
                                                        <a href="#" class="invoice-email">
                                                            <img src="image/invoice-info.png"><span>Your invoice will be send to your email</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <a href="" class="btn btn-style" id="add_address_btn">Save</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="order-summary-cont">
                    <div class="check-out-title">
                        <span>Order</span>
                        <h3>Summary</h3>
                    </div>
                    <div class="checkout-or-wrap">

                        @foreach($cart_data as $key=>$val)
            
                            @if(!empty($val->item_data))

                                @foreach($val->item_data as $key1=>$val1)
                                    @if($val1->qty > 0)

                                        <div class="row checkout-order-desc">
                                            <div class="col-xl-2 col-lg-2 col-md-2 col-12 checkout-order-detail">
                                                <a href="{{ url('product_details/'.$val->item_id) }}" class=""><img src="{{ $val->item_image }}" alt="{{ $val->item_name }}" class="img-fluid"></a>
                                            </div>
                                            <div class="col-xl-3 col-lg-3 col-md-4 col-12 checkout-order-detail">
                                                <div class="checkout-p-de">
                                                    <h5><a href="{{ url('product_details/'.$val->item_id) }}">{{ $val->item_name }}</a></h5>
                                                    <p>{{ $val1->capacity }}</p>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-lg-3 col-md-2 col-12 checkout-order-detail">
                                                <div class="checkout-or-price">
                                                    <span class="pr"><img src="{{ url('image/bengali-letter-black.png') }}" alt="">{{ $val1->price }}</span>
                                                    <span class="qyt">X{{ $val1->qty }}</span>
                                                </div>
                                            </div>
                                            <div class="col-xl-2 col-lg-2 col-md-2 col-12 checkout-order-detail">
                                                <div class="checkout-link">
                                                    <a href="#">Checkout</a>
                                                </div>
                                            </div>
                                            <div class="col-xl-2 col-lg-2 col-md-2 col-12 checkout-order-detail">
                                                <div class="checkout-p-total">
                                                    <span><img src="{{ url('image/bengali-letter-black.png') }}" alt="">{{ $val1->price*$val1->qty }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    @endif
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

                        <div id="offer_box"></div>

                    </div>
                </div>
            </div>
            <div class="col check-out-wrap">
                <div class="check-out-total">
                    <div class="offer-box-checkout">
                        @if(isset($offer->offer_code))
                            <form action="{{ url('offer_remove') }}" method="post" id="offer_remove_frm">
                                {{ csrf_field() }}
                                <div class="col-12 offer-apply-box">
                                    <div class="row">
                                        <a href="#" title="Remove Offer" id="remove_offer_btn">
                                            Offer Applied ({{ $offer->offer_code }}) 
                                            <span><i class="fas fa-times-circle"></i> </span>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        @else
                            <img class="offer-img" src="{{ asset('image/sale.png') }}" alt=""> 
                            <a href="{{ url('offer') }}" class="align-self-center" style=""> &nbsp;&nbsp;Apply Offer</a>
                        @endif
                    </div>
                    <ul>
                        <li>
                            <span class="check-s-title">Sub Total</span>
                            <span class="check-t-price"><img src="{{ url('image/sub-t-bengali-letter.png') }}" alt=""> {{ $total_data->subtotal }}</span>
                        </li>
                        <li>
                            <span class="check-s-title">Delivery Fee</span>
                            <span class="check-t-price"><img src="{{ url('image/sub-t-bengali-letter.png') }}" alt=""> {{ $total_data->delivery_fee }}</span>
                        </li>
                        <li>
                            <span class="check-s-title">Discount</span>
                            <span class="check-t-price"><img src="{{ url('image/sub-t-bengali-letter.png') }}" alt=""> {{ $total_data->discount }}</span>
                        </li>
                    </ul>
                    <div class="check-total">
                        <span>Total</span>
                        <span><img src="{{ url('image/sub-t-bengali-letter.png') }}" alt=""> {{ $total_data->total }}</span>
                    </div>
                    <div class="edit-order-cont">
                        <a href="{{ url('cart') }}" class="edit-order-btn">Edit your order</a>
                        <a href="{{ url('payment') }}" class="procced-pay-btn">Procced to Payment</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('footer_js')
<script>
    $(document).ready(function(){
        load_address_block();
        // load_offer_block();
    });

    function load_address_block(){
        $.ajax({
            type:'GET',
            url:'{{ url("load_address_block") }}',
            dataType: "json",
            success:function(data) {

                // console.log(data);

                if(data.re){
                    window.location.href = "{{ url('') }}/"+data.re;
                }
                // console.log(data);
                $("#address_box").html(data.view_data);
            }
        });
    }

    function load_offer_block(){
        $.ajax({
            type:'GET',
            url:'{{ url("load_offer_block") }}',
            dataType: "json",
            success:function(data) {
                if(data.re){
                    window.location.href = "{{ url('') }}/"+data.re;
                }
                // console.log(data);
                $("#offer_box").html(data.view_data);
            }
        });
    }

    $("#add_address_btn").click(function(e){
        e.preventDefault();

        name = $('#name').val();
        address = $('#address').val();
        address2 = $('#address2').val();
        contact = $('#contact').val();
        email = $('#email').val();
        is_primary = 0;
        // if($("#is_primary").prop("checked") == true){
        if($("input[name=is_primary]").prop("checked") == true){
            is_primary = 1;
        }

        $.ajax({
            type:'POST',
            url:'/add_new_address',
            dataType: "json",
            data: {
                "_token": "{{ csrf_token() }}",
                "name": name,
                "address": address,
                "address2": address2,
                "contact": contact,
                "email": email,
                "is_primary": is_primary
            },
            success:function(data) {

                if(data.re){
                    window.location.href = "{{ url('') }}/"+data.re;
                }

                // console.log(data);
                $(".msg-error,.msg-success").html('');
                if(data.error){
                    $(".msg-error").html('<div class="alert alert-danger"><ul><li>'+data.error+'</li></ul></div>');
                }
                if(data.success){
                    $("#add_address_frm")[0].reset();
                    $("#add-new-address").modal("hide");
                    $(".msg-success-o").html('<div class="alert alert-success"><ul><li>'+data.success+'</li></ul></div>').show().delay(3000).fadeOut();
                }
                load_address_block();
                // $("#msg").html(data.msg);
            }
        });
    });

    $("#remove_offer_btn i").click(function(e){
        e.preventDefault();
        $("#offer_remove_frm").submit();
    });

    $(document).on('change', 'input[name="address_radio"]', function(e) {
        save_address();
    });
    $(document).on('change', 'select[name="address_select"]', function(e) {
        save_address();
    });

    function save_address(){
        address_id = "";
        if($('input[name="address_radio"]').is(':checked')) {
            radio_val = $("input[name='address_radio']:checked").val();
            if(radio_val == "other_address"){
                address_id = $('select[name="address_select"]').val();
            }else{
                address_id = radio_val;
            }
        }
        
        $.ajax({
            type:'POST',
            url:'{{ url("save_address_to_session") }}',
            dataType: "json",
            data: {
                "_token": "{{ csrf_token() }}",
                "address_id": address_id,
                "address_radio": radio_val
            },
            success:function(data) {

                if(data.re){
                    window.location.href = "{{ url('') }}/"+data.re;
                }

            }
        });
    }

    $(".procced-pay-btn").click(function(e){
        e.preventDefault();

        address_id = "";
        if($('input[name="address_radio"]').is(':checked')) {
            radio_val = $("input[name='address_radio']:checked").val();
            if(radio_val == "other_address"){
                address_id = $('select[name="address_select"]').val();
            }else{
                address_id = radio_val;
            }
        }

        if(address_id == ""){
            $(".msg-error-o").html('<div class="alert alert-danger"><ul><li>select atleast one address</li></ul></div>').show().delay(3000).fadeOut();
            return false;
        }

        // name = $('#name').val();
        // address = $('#address').val();
        // address2 = $('#address2').val();
        // contact = $('#contact').val();
        // email = $('#email').val();
        // is_primary = 0;
        // if($("#is_primary").prop("checked") == true){
        //     is_primary = 1;
        // }

        $.ajax({
            type:'POST',
            url:'{{ url("send_to_payment") }}',
            dataType: "json",
            data: {
                "_token": "{{ csrf_token() }}",
                "address_id": address_id,
                "address_radio": radio_val,
                // "address": address,
                // "address2": address2,
                // "contact": contact,
                // "email": email,
                // "is_primary": is_primary
            },
            success:function(data) {

                if(data.re){
                    window.location.href = "{{ url('') }}/"+data.re;
                }

                if(data.status){
                    window.location.replace("{{ url('payment') }}");
                }
                if(data.success){
                    $("#add_address_frm")[0].reset();
                    $("#add-new-address").modal("hide");
                    $(".msg-success-o").html('<div class="alert alert-success"><ul><li>'+data.success+'</li></ul></div>').show().delay(3000).fadeOut();
                }
                load_address_block();
                // $("#msg").html(data.msg);
            }
        });
    });
</script>
@endsection