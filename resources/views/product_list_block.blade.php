@foreach ($page_data as $key=>$val)
    <div class="col otc-edicine-pro-img page_{{$page}}">
        <div class="single-product">
            <div class="product-img">
                <a href="{{ url('product_details/' . $val->_id) }}">
                    <img class="img-fluid" src="{{ $val->images[0]->img }}">
                </a>
            </div>
            <div class="prodyct-content">
                <h6><a href="{{ url('product_details/' . $val->_id) }}">{{ $val->prod_name }}</a></h6>
                <p>{!! urldecode($val->prod_desc) !!}</p>
                <span><sup>৳</sup>{{$val->inventory[0]->price}}</span>
            </div>
        </div>
    </div>
@endforeach