<div class="payment-address-cont">
    <div class="payment-address-desc">
        @if(isset($all_address))
            @foreach($all_address as $key=>$val)
                @if($val->is_primary == 1)
                    <label class="cus-radio">
                        <span class="payment-radio-title">Primary address</span>
                        <input type="radio" name="address_radio" value="{{$val->_id}}" @if(session()->has('checkout_address') && session()->get('checkout_address')->address_radio != "other_address") checked @endif>
                        <span class="checkmark"></span>
                    </label>
                    <p class="payment-address">{!! urldecode($val->address) !!}</p>
                @endif
            @endforeach
        @endif
    </div>
    <div class="payment-address-desc">
        <label class="cus-radio">
            <span class="payment-radio-title">Others Delivery Addresses</span>
            <input type="radio" name="address_radio" value="other_address" @if(session()->has('checkout_address') && session()->get('checkout_address')->address_radio == "other_address") checked @endif>
            <span class="checkmark"></span>
        </label>
        <div class="others-address">
            <span class="arrow-set">
                <select class="add-select" name="address_select">
                    @if(isset($all_address))
                        @foreach($all_address as $key=>$val)
                            @if($val->is_primary == 0)
                                <option value="{{$val->_id}}" @if(session()->has('checkout_address') && session()->get('checkout_address')->address_id == $val->_id) selected @endif>{!! urldecode($val->address) !!}</option>
                            @endif
                        @endforeach
                    @endif
                </select>
            </span>
            <div class="add-new-ad">
                <a href="#" class="new-ad-btn" data-toggle="modal" data-target="#add-new-address">Add New Address</a>
            </div>
        </div>
    </div>
</div>