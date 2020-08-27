@extends('layout.master')

@section('content')
<section class="product-detail-sec">
    <div class="container">
        <div class="row product-main-wrap">

            <div class="col-md-12 product-main-wrap-cont">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-5 col-12 product-preview">
                        <div class="product-sidebar-item">
                            <!-- product main image start -->
                            <div class="preview-pic tab-content">
                                <div class="tab-pane text-center active" id="pic-1">
                                    <a href="javascript:void(0)" class="zoom"><img src="{{ $product->dis_image }}" alt="pro1" class="img-fluid"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-8 col-md-7 col-12 product-info-cont">
                        <div class="product-info-inner">
                            <div class="product-title-desc">
                                <h3>
                                    <a href="#">{{ $product->dis_name }}</a>
                                </h3>
                                <p>
                                    {!! urldecode($product->dis_desc) !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <br/><br/>
            </div>

        </div>

    </div>
</section>
@include('partials.backtotop')
@endsection

@section('footer_js')
    <script>
        // price_display();
        // $('input[type=radio][name=price_radio]').change(function() {
        //     price_display();
        // });

        // function price_display(){
        //     var price_select = $("input[name='price_radio']:checked").val();
        //     $('.price_block').html(price_select);
        // }
    </script>
@endsection