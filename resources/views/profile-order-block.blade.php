<div class="order-history-tab-cont">
    <div class="order-history-det">
        <div class="check-out-title">
            <span>Order</span>
            <h3>History</h3>
        </div>
        <div class="checkout-or-wrap">

        @isset($order_history)
            
            @foreach($order_history as $key=>$val)
                {{--@foreach($val->order_data as $key1=>$val1)--}}
                    {{--@foreach($val1->item_data as $key2=>$val2)--}}
                        <div class="row checkout-order-desc">
                            <div class="col-xl-2 col-lg-2 col-md-2 col-12 checkout-order-detail">
                                <a href="{{ url('product_details/'.$val->order_data[0]->item_id) }}" class=""><img src="{{ $val->order_data[0]->item_image }}" alt="pro1" class="img-fluid"></a>
                            </div>
                            <div class="col-xl-5 col-lg-4 col-md-4 col-12 checkout-order-detail">
                                <div class="checkout-p-de">
                                    <h5><a href="{{ url('product_details/'.$val->order_data[0]->item_id) }}">{{ $val->order_data[0]->item_name }}</a></h5>
                                    <p>{{ date('d - M - Y',$val->placed_on) }}</p>
                                    <p>Order ID : {{ $val->order_ref }}</p>
                                </div>
                            </div>
                            <!-- <div class="col-xl-2 col-lg-3 col-md-3 col-12 checkout-order-detail">
                                <div class="checkout-or-price">
                                    <span class="pr"><img src="image/bengali-letter-black.png" alt=""></span>
                                    <span class="qyt"></span>
                                </div>
                            </div> -->
                            <div class="col-xl-5 col-lg-3 col-md-3 col-12 checkout-order-detail d-flex justify-content-end">
                                <div class="checkout-p-total">
                                    <span class="d-flex justify-content-end">
                                        <img src="{{ asset('image/bengali-letter-black.png') }}" alt="" height="30px">
                                        {{ $val->grand_total }}</span>
                                        @if($val->order_status == 0)
                                            <a class="text-danger"><h6 class="text-danger">Pending</h6></a>
                                        @elseif($val->order_status == 1)
                                            <a class="text-danger"><h6 class="text-danger">Accepted</h6></a>
                                        @elseif($val->order_status == 2)
                                            <a class="text-danger"><h6 class="text-danger">Packaging</h6></a>
                                        @elseif($val->order_status == 3)
                                            <a class="text-danger"><h6 class="text-danger">Dispatched</h6></a>
                                        @elseif($val->order_status == 4)
                                            <a class="text-danger"><h6 class="text-danger">On the Way</h6></a>
                                        @elseif($val->order_status == 5)
                                            <a class="text-danger"><h6 class="text-danger">Arrived</h6></a>
                                        @elseif($val->order_status == 6)
                                            <a class="text-danger"><h6 class="text-danger">Delivered</h6></a>
                                        @elseif($val->order_status == 7)
                                        <a class="text-success"><h6 class="text-success">Completed</h6></a>

                                    @endif
                                    &nbsp;&nbsp;&nbsp;
                                    <button class="btn order-repeat" order_id="{{ $val->_id }}">Order again</button>
                                </div>
                            </div>
                        </div>
                    {{--@endforeach--}}
                {{--@endforeach--}}
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