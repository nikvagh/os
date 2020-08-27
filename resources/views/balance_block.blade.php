<div class="balance-tab-cont">

    <div class="balance-block1">
        <h2>Wallet Balance</h2>
        <div class="balance-tab-desc">

            <div class="row balance_box">
                <div class="balance-tab-total col-9">
                    <img src="{{ asset('image/pocket-total.png') }}" alt="pocket-total">
                    <h5>Total balance</h5>
                </div>
                <div class="balance-total-p col-3">
                    <h2>
                        <sup><img src="{{ asset('image/cart-b-letter.png') }}" alt="cart-b-letter"></sup>
                        <span>{{ Session::get('user')->wallet_amount + Session::get('user')->wallet_gift }}</span>
                    </h2>
                </div>
            </div>
        </div>
        <div class="ad-money-history">
            <!-- <a href="#" class="btn btn-style">Add Money</a> -->
            <a href="#" class="btn btn-style" data-toggle="modal" data-target="#add-money-modal">Add Money</a>
            <a href="#" class="btn v-history">View History</a>
        </div>
        <hr>
    
        <div class="balance-text-block">
            <h5 class="title">What is OsudPotro cash?</h5>
            <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
        </div>
    </div>

    <div class="balance-block2 display-none">
        <div class="history_box">

            <a class="cursor-pointer" id="balance_his_title"><span class="title"><i class="fas fa-chevron-left"></i> &nbsp;  Wallet History</span></a>
            <div class="col-12">
                <div class="row balance-history checkout-order-desc">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-12 checkout-order-detail">
                        <div class="checkout-p-de">
                            <h5>Total balance</h5>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-12 balance-total-p text-right">
                        <h2>
                            <sup><img src="{{ asset('image/cart-b-letter.png') }}" alt="cart-b-letter"></sup>
                            <span>{{ Session::get('user')->wallet_amount + Session::get('user')->wallet_gift }}</span>
                        </h2>
                    </div>

                </div>
                @foreach($balance_history as $key => $val)
                    <div class="row balance-history checkout-order-desc">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-12 checkout-order-detail">
                            <div> Transaction ID : {{ $val->_id}} </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-12 checkout-order-detail">
                            <b>Amount: @if($val->amount < 0) <img src="{{ asset('image/bengali-letter-black.png') }}" alt="" style="width:12px;"> @else <img src="{{ asset('image/bengali-letter-black.png') }}" alt="" style="width:12px;"> @endif {{ $val->amount }}  </span> </b> 
                        </div>   
                        <div class="col-xl-12 col-lg-12 col-md-12 col-12 checkout-order-detail"> 
                            Status : @if($val->payment_status == 1) <span class="text-success"> Completed</span>  @else <span class="text-danger"> Fail</p> @endif  </span>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-12 checkout-order-detail"> 
                            <span> Date : {{ date('d - M - Y', strtotime($val->added_on))  }} </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</div>

