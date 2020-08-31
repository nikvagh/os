@if(isset($all_address))
<ul>              
        <li>
            <div class="payment-address-cont">
                <div class="payment-address-desc" style="width:100%">

                    <label class="cus-radio text-left">
                        <span class="payment-radio-title">Primary Address</span>
                        <input type="radio" name="radio_address" cheched value="">
                        <span class="checkmark"></span>
                    </label>

                        @foreach($all_address as $key=>$val)
                            @if($val->is_primary == 1)

                                <div class="row address_list checkout-order-desc">
                                    <div class="col-xl-8 col-lg-8 col-md-8 text-left">
                                        <p class="payment-address">{{ $val->address }} {{ $val->address2 }}</p>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-4 text-right">
                                        <div class="payment-address-desc1">
                                            <a class="c-pointer" onclick="edit_arrdess('{{ $val->_id }}')"><i class="fas fa-pen"></i></a>
                                        </div>
                                    </div>
                                </div>

                            @endif
                        @endforeach

                </div>
            </div>
        </li>

        <li>
            <div class="payment-address-cont">
                <div class="payment-address-desc" style="width:100%">

                    <label class="cus-radio text-left">
                        <span class="payment-radio-title">Other Addresses</span>
                        <input type="radio" name="radio_address" cheched value="">
                        <span class="checkmark"></span>
                    </label>

                    @foreach($all_address as $key=>$val)
                        @if($val->is_primary != 1)

                            <div class="address_list checkout-order-desc">
                                <div class="row">
                                    <div class="col-xl-8 col-lg-8 col-md-8 text-left">
                                        <p class="payment-address">{{ $val->address }} {{ $val->address2 }}</p>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-4 text-right">
                                        <div class="payment-address-desc1">
                                            <a class="c-pointer" onclick="edit_arrdess('{{ $val->_id }}')"><i class="fas fa-pen"></i></a>
                                            <a class="c-pointer text-danger" onclick="delete_arrdess('{{ $val->_id }}')"><i class="fas fa-trash"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endif
                    @endforeach

                </div>
            </div>
        </li>
        
</ul>
@endif

@if(isset($all_address_msg))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <ul>
            <li> <i class="fa fa-exclamation-circle"></i> {{ $all_address_msg }} </li>
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        </button>
    </div>
@endif