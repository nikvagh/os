
@extends('layout.master')

@section('content')

<section class="section-wrap search-pro-section">
    <div class="container">
        <div class="row">
            <div class="col">

                    @forelse ($serch_data as $key=>$val)
                        <div class="section-padding">
                            <div class="other-section-title">
                                <h2>
                                    <span class="title2 text-capitalize">{{ $val->item_type }}</span>
                                </h2>
                            </div>

                            <div class="otc-edicine-product">
                                <div class="row otc-edicine-pro-desc">

                                    @foreach ($val->item_data as $key1=>$val1)

                                        @if ($val->item_type != "doctors")

                                            @if ($val->item_type == "disease")
                                                <div class="col otc-edicine-pro-img">
                                                    <div class="single-product">
                                                        <div class="product-img">
                                                            <a href="{{ url('disease_details/' . $val1->_id) }}">
                                                                <img class="img-fluid" src="{{$val1->dis_image}}">
                                                            </a>
                                                        </div>
                                                        <div class="prodyct-content">
                                                            <h6><a href="{{ url('disease_details/' . $val1->_id) }}">{{$val1->dis_name}}</a></h6>
                                                            <p>{!! urldecode($val1->dis_desc) !!}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            @if($val->item_type == "product")
                                                <div class="col otc-edicine-pro-img">
                                                    <div class="single-product">
                                                        <div class="product-img">
                                                        <a href="{{ url('product_details/' . $val1->_id) }}">
                                                                <img class="img-fluid" src="{{$val1->images[0]->img}}">
                                                            </a>
                                                        </div>
                                                        <div class="prodyct-content">
                                                            <h6><a href="{{ url('product_details/' . $val1->_id) }}">{{$val1->prod_name}}</a></h6>
                                                            <p>{!! urldecode($val1->prod_desc) !!}</p>
                                                            <span><sup>৳</sup>{{$val1->inventory[0]->price}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            @if($val->item_type == "medicine")
                                                <div class="col otc-edicine-pro-img">
                                                    <div class="single-product">
                                                        <div class="product-img">
                                                            @if(!empty($val1->images))
                                                                <a href="{{ url('medicine_details/' . $val1->_id) }}">
                                                                    <img class="img-fluid" src="{{$val1->images[0]->img}}">
                                                                </a>
                                                            @endif
                                                        </div>
                                                        <div class="prodyct-content">
                                                            <h6><a href="{{ url('medicine_details/' . $val1->_id) }}">{{$val1->brand_name}}</a></h6>
                                                            <p>{!! urldecode($val1->description) !!}</p>
                                                            <span><sup>৳</sup>{{$val1->inventory[0]->price}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                        @else

                                            //doctor
                                        @endif

                                    @endforeach

                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="section-padding">
                            <div class="other-section-title">

                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <ul>
                                        <li> <i class="fa fa-exclamation-circle"></i> No search result found for <b>"{{$needle}}"</b></li>
                                    </ul>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <!-- <span aria-hidden="true">&times;</span> -->
                                    </button>
                                </div>

                            </div>
                        </div>
                    @endforelse

            </div>
        </div>
    </div>
</section>

@endsection

@section('footer_js')
@endsection
