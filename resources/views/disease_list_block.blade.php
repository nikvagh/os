@foreach ($page_data as $key=>$val)
    <div class="col otc-edicine-pro-img page_{{$page}}">
        <div class="single-product">
            <div class="product-img">
                <a href="{{ url('disease_details/' . $val->_id) }}">
                    <img class="img-fluid" src="{{ $val->dis_image }}">
                </a>
            </div>
            <div class="prodyct-content">
                <h6><a href="{{ url('disease_details/' . $val->_id) }}">{{ $val->dis_name }}</a></h6>
                <p>{!! urldecode($val->dis_desc) !!}</p>
            </div>
        </div>
    </div>
@endforeach