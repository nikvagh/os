@extends('layout.master')

@section('content')
<section class="profile-section section-padding section-bottom-border">
    <div class="container">
        <div class="row profile-wrap">
            <div class="col profile-cont">
                <div class="profile-tab">
                    <ul class="nav nav-pills" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="pill" href="#profile" id="profile_tab_btn">
                                <span class="pre-title">Profile</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " data-toggle="pill" href="#order-history" id="order_history_tab_btn">
                                <span class="pre-title">Order History</span>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#order-delivery-ad" id="address_tab_btn">
                                <span class="pre-title">Other Delivery Address </span>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#balance" id="balance_tab_btn">
                                <span class="pre-title">Wallet</span>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col profile-cont">
                <span class="msg-success-o width-100p"></span>
                <span class="msg-error-o width-100p"></span>

                <div class="tab-content">
                    <div class="tab-pane active" id="profile">
                        <!-- <div class="profile-tab-cont">
                            <h2>Profile</h2>
                            <div class="profile-tab-desc">
                                <div class="profile-img">
                                    @if($profile->image)
                                        <a href="#"><img src="{{ $profile->image }}" alt="profile"></a>
                                    @else
                                        <a href="#"><img src="{{ asset('image/avtar.jpg') }}" alt="profile"></a>
                                    @endif
                                </div>
                                <div class="profile-name">
                                    <h6>Name</h6>
                                    <span>{{ $profile->name }}</span>
                                </div>
                            </div>
                            <div class="profile-detail">
                                <ul>
                                    <li>
                                        <h6>Address</h6>
                                        <span>H. No.-136, Road-10, Block-A, Bashundhara R/A, Dhaka-1212</span>
                                    </li>
                                    <li>
                                        <div class="area-cont-detail">
                                            <div class="area-cont">
                                                <h6>area</h6>
                                                <span>Bashundhara R/A, Dhaka-1212</span>
                                            </div>
                                            <div class="area-cont">
                                                <h6>Contact Number</h6>
                                                <span>{{ $profile->mobile }}</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <h6>Email</h6>
                                        <span>{{ $profile->email }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div> -->
                    </div>
                    <div class="tab-pane" id="order-history">
                        <div class="order-history-tab-cont">
                            <div class="order-history-det">
                                <div class="check-out-title">
                                    <span>Order</span>
                                    <h3>History</h3>
                                </div>
                                <div class="checkout-or-wrap">

                                @isset($order_history)
                                    
                                    @foreach($order_history as $key=>$val)
                                        @foreach($val->order_data as $key1=>$val1)
                                            @foreach($val1->item_data as $key2=>$val2)
                                                <div class="row checkout-order-desc">
                                                    <div class="col-xl-2 col-lg-2 col-md-2 col-12 checkout-order-detail">
                                                        <a href="{{ url('product_details/'.$val1->item_id) }}" class=""><img src="{{ $val1->item_image }}" alt="pro1" class="img-fluid"></a>
                                                    </div>
                                                    <div class="col-xl-5 col-lg-4 col-md-4 col-12 checkout-order-detail">
                                                        <div class="checkout-p-de">
                                                            <h5><a href="{{ url('product_details/'.$val1->item_id) }}">{{ $val1->item_name }}</a></h5>
                                                            <p>{{ $val2->capacity }}</p>
                                                            <p>Order ID : {{ $val1->_id }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-2 col-lg-3 col-md-3 col-12 checkout-order-detail">
                                                        <div class="checkout-or-price">
                                                            <span class="pr"><img src="image/bengali-letter-black.png" alt="">{{ $val2->price }}</span>
                                                            <span class="qyt">X{{ $val2->qty }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-3 col-lg-3 col-md-3 col-12 checkout-order-detail">
                                                        <div class="checkout-p-total">
                                                            <span><img src="{{ asset('image/bengali-letter-black.png') }}" alt="">{{ $val2->price*$val2->qty }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                    
                                @else
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <ul>
                                            <li> <i class="fa fa-exclamation-circle"></i> {{ $order_history_msg }}</li>
                                        </ul>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <!-- <span aria-hidden="true">&times;</span> -->
                                        </button>
                                    </div> 
                                @endisset

                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="order-delivery-ad">
                        <div class="order-delivery-tab-cont">
                            <div class="check-out-title">
                                <span>Other</span>
                                <h3>Delivery Address</h3>
                            </div>
                            <div class="order-delivery-detail">

                            </div>
                            <div class="add-new-addr">
                                <!-- <a href="#" class="deviler-add-new">Add New Address</a> -->
                                <a href="#" class="new-ad-btn" data-toggle="modal" data-target="#add-new-address">Add New Address</a>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="balance">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

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

                                <!-- <div class="new-addr-form-input">
                                    <div class="form-group">
                                        <label>Area</label>
                                        <input type="text" placeholder="Area">
                                    </div>
                                    <div class="form-group">
                                        <label>Contact Number</label>
                                        <input type="tel" name="contact" id="contact" placeholder="">
                                    </div>
                                </div> -->
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
                                            <img src="{{ asset('image/invoice-info.png') }}">Your invoice will be send to your email
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

<div class="add-new-address-modal" id="add-money-box">
    <div class="modal fade" id="add-money-modal">
        <div class="modal-dialog">

            <div class="modal-content">

                <!-- <div class="modal-header">
                    <h4 class="modal-title">Add Money</h4>
                </div> -->

                
                <div class="modal-body">
                    <h4 class="text-center modal-title">Add Wallet Money</h4>
                    <span class="msg-success width-100p"></span>
                    <span class="msg-error width-100p"></span>
                    <div class="new-addr-form-money">
                        <form id="add_money_frm" method="post">
                            <div class="new-addr-form-input">
                                <div class="form-group">
                                    <input type="text" name="amount" id="amount" placeholder="Enter Amount" class="text-center">
                                </div>
                            </div>
                        </form>
                        <br/><br/>
                        <div class="text-center d-flex justify-content-center">
                            <a href="" class="btn btn-style-bottom-top btn-block" id="add_money_btn">Save</a>
                        </div>
                    </div>

                </div>
                <!-- <div class="modal-footer">
                    <a href="" class="btn btn-style" id="add_money_btn">Add</a>
                </div> -->

            </div>

        </div>
    </div>
</div>

<div class="add-new-address-modal"  id="edit-address-box">

</div>

@endsection

@section('footer_js')
    <script>
        // order-delivery-detail
        $(document).ready(function(){
            load_profile_block();
        });

        $("#profile_tab_btn").click(function(){
            load_profile_block();
        });

        $("#address_tab_btn").click(function(){
            load_address();
        });

        $("#balance_tab_btn").click(function(){
            load_balance_block();
        });
        $(document).on('click', '#balance_his_title', function(e) {
            load_balance_block();
        });

        function load_profile_block(){
            $.ajax({
                type:'GET',
                url:'/profile-block',
                success:function(data) {
                    // console.log(data);
                    // $(".msg-error,.msg-success").html('');
                    $("#profile").html(data);
                }
            });
        }

        function load_address(){
            $.ajax({
                type:'GET',
                url:'/load_address',
                success:function(data) {
                    // console.log(data);
                    // $(".msg-error,.msg-success").html('');
                    $(".order-delivery-detail").html(data);
                }
            });
        }

        $(document).on('click', '.v-history', function(e) {
            e.preventDefault();
            // $('.balance-tab-desc').addClass('display-none');
            // $('.history_box').removeClass('display-none');
            $('.balance-block1').addClass('display-none');
            $('.balance-block2').removeClass('display-none');
        });

        $("#add_money_btn").click(function(e){
            e.preventDefault();
            amount = $('#amount').val();

            $.ajax({
                type:'POST',
                url:'{{ url("add_money") }}',
                dataType: "json",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "amount": amount
                },
                success:function(data) {
                    // console.log(data);
                    $(".msg-error,.msg-success").html('');
                    if(data.error){
                        $(".msg-error").html('<div class="alert alert-danger"><ul><li>'+data.error+'</li></ul></div>');
                    }
                    if(data.success){
                        $("#add_money_frm")[0].reset();
                        $("#add-money-modal").modal("hide");
                        $(".msg-success-o").html('<div class="alert alert-success"><ul><li>'+data.success+'</li></ul></div>').show().delay(3000).fadeOut();
                    }
                    load_balance_block();
                    // $("#msg").html(data.msg);
                }
            });
        });

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
                    load_address();
                    // $("#msg").html(data.msg);
                }
            });
        });

        function delete_arrdess(address_id){
            if(confirm('Are You sure to delete address ?')){
                $(".msg-success-o").html('');
                $.ajax({
                    type:'POST',
                    url:'/delete_address',
                    dataType: "json",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "address_id": address_id
                    },
                    success:function(data) {
                        // console.log(data);
                        load_address();
                        $(".msg-success-o").html('<div class="alert alert-success"><ul><li>'+data.success+'</li></ul></div>').show().delay(3000).fadeOut();
                    }
                });

            }
        }

        function edit_arrdess(address_id){
            $.ajax({
                type:'GET',
                url:'/get_edit_address/'+address_id,
                success:function(data) {
                    $("#edit-address-box").html(data);
                    $("#edit-address").modal('show');
                }
            });
        }

        function load_balance_block(){
            $.ajax({
                type:'GET',
                url:'/load_balance_block',
                success:function(data) {
                    // console.log(data);
                    // $(".msg-error,.msg-success").html('');
                    $("#balance").html(data);
                }
            });
        }

        $(document).on('click', '#edit_address_btn', function(e) {
            e.preventDefault();

            name = $('#name_e').val();
            address = $('#address_e').val();
            address2 = $('#address2_e').val();
            contact = $('#contact_e').val();
            email = $('#email_e').val();
            address_id = $('#address_id_e').val();
            is_primary = 0;
            if($("#is_primary_e").prop("checked") == true){
                is_primary = 1;
            }

            $.ajax({
                type:'POST',
                url:'/update_address',
                dataType: "json",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "name": name,
                    "address": address,
                    "address2": address2,
                    "contact": contact,
                    "email": email,
                    "is_primary": is_primary,
                    "address_id": address_id
                },
                success:function(data) {
                    // console.log(data);
                    $(".msg-error,.msg-success").html('');
                    if(data.error){
                        $(".msg-error").html('<div class="alert alert-danger"><ul><li>'+data.error+'</li></ul></div>');
                    }
                    if(data.success){
                        // $("#add_address_frm")[0].reset();
                        $("#edit-address").modal("hide");
                        $(".msg-success-o").html('<div class="alert alert-success"><ul><li>'+data.success+'</li></ul></div>').show().delay(3000).fadeOut();
                    }
                    load_address();
                    // $("#msg").html(data.msg);
                }
            });
        });

        $(document).on('change','input[name="radio_address"]', function(e) {
            address_id = $(this).val();
            is_primary = 1;

            $.ajax({
                type:'POST',
                url:'/change_address_status',
                dataType: "json",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "is_primary": is_primary,
                    "address_id": address_id
                },
                success:function(data) {
                    $(".msg-error,.msg-success").html('');
                    if(data.error){
                        $(".msg-error-o").html('<div class="alert alert-danger"><ul><li>'+data.error+'</li></ul></div>');
                    }
                    if(data.success){
                        // $("#add_address_frm")[0].reset();
                        $("#edit-address").modal("hide");
                        $(".msg-success-o").html('<div class="alert alert-success"><ul><li>'+data.success+'</li></ul></div>').show().delay(3000).fadeOut();
                    }
                    load_address();
                    // $("#msg").html(data.msg);
                }
            });
        });
        

    </script>
@endsection

