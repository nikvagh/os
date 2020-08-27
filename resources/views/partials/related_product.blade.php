@if(!empty($related_products))
<section class="section-wrap related-block">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="section-padding section-border recomanded-slider-section">
                    <div class="other-section-title">
                        <h2>
                            <span class="title1">Explore</span>
                            <span class="title2">Related Products</span>
                        </h2>
                    </div>
                    <div class="medicine">
                        <div class="section-product">
                            <div class="owl-carousel owl-theme medicine-slider" id="recomanded-slider">
                                @foreach($related_products as $key=>$val)
                                    <div class="item">
                                        <div class="single-product">
                                            <div class="product-img">
                                                <a href="{{ url('product_details/'.$val->_id) }}">
                                                    <img class="img-fluid" src="{{$val->images[0]->img}}">
                                                </a>
                                            </div>
                                            <div class="prodyct-content">
                                                <h6><a href="javascript:void(0)">{{$val->prod_name}}</a></h6>
                                                <p>{!! urldecode($val->prod_desc) !!}</p>
                                                <span><sup>৳</sup>{{$val->inventory[0]->price}}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif