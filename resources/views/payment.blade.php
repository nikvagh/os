@extends('layout.master')

@section('content')

<section class="check-out-section payment-m-section">
    <div class="container">
        <div class="row">
            <div class="col check-out-wrap">
                <div class="check-out-desc">
                    <div class="check-out-title">
                        <span>Checkout</span>
                        <h3>Payment</h3>
                    </div>
                </div>

                <span class="msg-success-o width-100p"></span>
                <span class="msg-error-o width-100p"></span>

                <form id="order_frm" action="" method="post">
                    
                    {{ csrf_field() }}
                    <input type="hidden" name="payment_method" id="payment_method"/>
                    <div class="pay-option-cont">

                        <div class="pay-option-detail">
                            <a href="" data-toggle="collapse" data-target="#pay-op1" id="cod_box">
                                <img src="{{ url('image/pay-icon1.png') }}" alt="pay-icon1">
                                <span>Cash on Delivery</span>
                            </a>
                            <div id="pay-op1" class="collapse">

                            </div>
                        </div>

                        <div class="pay-option-detail">
                            <a href="" data-toggle="collapse" data-target="#pay-op2" id="ssl_commerz_box">
                                <img src="{{ url('image/ssl-logo.png') }}" alt="pay-icon1">
                                <span>Pay with SSLCOMMERZ</span>
                            </a>
                            <div id="pay-op2" class="collapse">

                            </div>
                        </div>
                        <div class="pay-option-detail">
                            <a href="" data-toggle="collapse" data-target="#pay-op3" id="osud_wallet_box">
                                <img src="{{ url('image/pay-icon.png') }}" alt="pay-icon1">
                                <span>OsudPotro Wallet</span>
                            </a>
                            <div id="pay-op3" class="collapse">

                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="col check-out-wrap">
                <div class="check-out-total order-review-cont">
                    <div class="order-review">
                        <p>You can review this order before its final</p>
                    </div>
                    <div class="edit-order-cont">
                        <!-- <a href="#" class="procced-pay-btn" data-toggle="modal" data-target="#pay-continue">Continue</a> -->
                        <a href="{{ url('checkout') }}" class="procced-pay-btn">Continue</a>
                    </div>
                </div>
            </div>
            <div class="payment-modal">
                <div class="modal fade" id="pay-continue">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <div class="user-icon">
                                    <a href="#"><i class="fas fa-user"></i></a>
                                </div>
                                <button type="button" class="close" data-dismiss="modal"><i class="fas fa-times"></i></button>
                                <div class="user-i-name">
                                    <h6 class="modal-title">Demo</h6>
                                </div>
                            </div>
                            <div class="all-support-cont">
                                <ul>
                                    <li>
                                        <a href="#"><i class="fas fa-headphones-alt"></i></a>
                                        <span>Support</span>
                                    </li>
                                    <li>
                                        <a href="#"><i class="far fa-question-circle"></i></a>
                                        <span>FAQ</span>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fas fa-gift"></i></a>
                                        <span>Offer</span>

                                    </li>
                                    <li>
                                        <a href="#"><i class="fas fa-sign-in-alt"></i></a>
                                        <span>Login</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="payment-cards-detail">
                                <ul class="nav nav-pills" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active show" data-toggle="pill" href="#cards">
                                            <span class="pre-title">cards</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="pill" href="#mob-bank">
                                            <span class="pre-title">mobile banking</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="pill" href="#net-bank">
                                            <span class="pre-title">net banking</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="modal-body">
                                    <div class="tab-content">
                                        <div class="tab-pane active show" id="cart">
                                            <div class="card-option">
                                                <ul>
                                                    <li>
                                                        <a href="#"><i class="fab fa-cc-visa"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="#"><i class="fab fa-cc-mastercard"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="#"><i class="fab fa-cc-amex"></i></a>
                                                    </li>
                                                    <li>
                                                        <a href="#">Other Cards</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="card-all-detail">
                                                <div class="card-input-detail">
                                                    <input type="text" placeholder="Enter Card Number">
                                                    <div class="dropdown">
                                                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Avial EMI
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item" href="#">Avial EMI</a>
                                                            <a class="dropdown-item" href="#">Avial EMI</a>
                                                            <a class="dropdown-item" href="#">Avial EMI</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-date">
                                                    <input type="date">
                                                    <input type="text" placeholder="CVC/CVV">
                                                </div>
                                                <div class="card-holdername">
                                                    <input type="text" placeholder="Card Holder Name">
                                                </div>
                                                <div class="card-de-save">
                                                    <div class="card-de-desc">
                                                        <span class="card-save-cont">
                                                            <input type="checkbox" name="">
                                                            <span>Save Card & remember me</span>
                                                        </span>
                                                        <a href="#" class="question-circle"><i class="far fa-question-circle"></i></a>
                                                    </div>
                                                    <span class="check-boxing">By checking this boxing you agree to <a href="#" class="term-service">tearm of services</a></span>
                                                </div>

                                            </div>
                                        </div>
                                        <!-- <div class="tab-pane" id="mob-bank"></div>
                                                <div class="tab-pane" id="net-bank"></div> -->
                                    </div>
                                </div>
                                <div class="pay-bdt-link">
                                    <a href="#">
                                        <img src="image/link-bottom-icon.png" alt="">
                                        <span>pay 200 bdt</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('footer_js')
<script>
    $("#cod_box").click(function(){
        place_order('cod');
    });
    $("#osud_wallet_box").click(function(){
        place_order('osud_wallet');
    });
    $("#ssl_commerz_box").click(function(){
        // place_order('ssl_commerz');
        $("#order_frm").attr('action','{{ url("payssl") }}');
        $("#payment_method").val('ssl_commerz');
        $("#order_frm").submit();
        // return false;
    });

    function place_order(payment_method){
        // is_zero = check_for_not_all_zero();
        // if(is_zero == "Y"){
        //     $(".msg-error-o").html('<div class="alert alert-danger"><ul><li>Add atleast one qty more than zero</li></ul></div>').show().delay(3000).fadeOut();
        //     return false;
        // }
        // return false;

        var form = $("#order_frm")[0];
        var formData = new FormData(form);
        formData.append('_token', "{{ csrf_token() }}");
        formData.append('payment_method', payment_method);

        $.ajax({
            type:'POST',
            url:'{{ url("place_order") }}',
            dataType: "json",
            cache: false,
            contentType: false,
            processData: false,
            data : formData,
            success:function(data) {
                console.log(data);
                // return false;
                if(data.status){
                    // window.location.replace("{{ url('success') }}");
                    document.location.href="{!! url('success') !!}";
                }else{
                    if(data.re == "login"){
                        // window.location.replace("{{ url('login') }}");
                        document.location.href="{!! url('login') !!}";
                    }
                    if(data.re == "payment"){
                        $(".msg-error-o").html('<div class="alert alert-danger"><ul><li>'+data.message+'</li></ul></div>').show().delay(3000).fadeOut();
                    }
                    if(data.re == "cart"){
                        document.location.href="{!! url('cart') !!}";
                    }
                }
                // load_cart_block();
            }
        });
    }
    
</script>
@endsection