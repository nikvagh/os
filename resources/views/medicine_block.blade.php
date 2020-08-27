@foreach ($page_data as $key=>$val)
    <div class="col otc-edicine-pro-img">
        <div class="single-product">
            <div class="product-img">
                <a href="{{ url('medicine_details/' . $val->_id) }}">
                    <img class="img-fluid" src="{{ $val->images[0]->img }}">
                </a>
            </div>
            <div class="prodyct-content">
                <h6><a href="{{ url('medicine_details/' . $val->_id) }}">{{ $val->generic_name }}</a></h6>
                <p>{!! urldecode($val->description) !!}</p>
                <span><sup>৳</sup>{{$val->inventory[0]->price}}</span>
            </div>
        </div>
    </div>
@endforeach