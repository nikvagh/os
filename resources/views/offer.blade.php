@extends('layout.master')

@section('content')
    <section class="section-padding offer-disc-section">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                    <div class="other-section-title">
                        <h2>
                            <span class="title2">Available Offers</span>
                        </h2>
                    </div>
                </div>
            </div>

            <span class="msg-success-o width-100p"></span>
            <span class="msg-error-o width-100p"></span>

            <div class="offer-discount-pro">
                <div class="row">
                    @if(isset($offers))
                        @foreach($offers as $key=>$val)
                            <div class="col-xl-4 col-lg-6 col-md-6 col-12 offer-discount-detail">
                                <div class="offer-discount-cont">
                                    <!-- <div class="offer-discount-img">
                                        <img src="image/pro1.jpg" alt="pro1" class="img-fluid">
                                    </div> -->
                                    <div class="offer-discount-desc">
                                        <h4><a href="#">{{$val->offer_code}}</a></h4>
                                        <!-- <span class="">{{$val->offer_desc}}</span> -->
                                        <div class="offer-disc">
                                            <p>{{$val->offer_desc}}</p>
                                            <!-- <a href="#">View Detail</a> -->
                                        </div>
                                        <div class="try-new-btn">
                                            <a href="#" class="try_now" id="{{ $val->_id }}">try new</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12 offer-discount-detail">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <ul>
                                    <li> <i class="fa fa-exclamation-circle"></i> {{$empty_msg}} </li>
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </section>
@endsection

@section('footer_js')
    <script>
        // order-delivery-detail
        // $(document).ready(function(){
        //     load_cart_block();
        // });

        // function load_cart_block(){
        //     $.ajax({
        //         type:'GET',
        //         url:'{{ url("load_cart_block") }}',
        //         success:function(data) {
        //             // console.log(data);
        //             $("#cart_box").html(data);
        //         }
        //     });
        // }

        $(document).on('click', '.try_now', function(e) {
            e.preventDefault();
            var offer_id = $(this).attr('id');
            apply_coupon(offer_id);
        });

        function apply_coupon(offer_id){
            var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('offer_id', offer_id);

            $.ajax({
                type:'POST',
                url:'{{ url("apply_coupon") }}',
                dataType: "json",
                cache: false,
                contentType: false,
                processData: false,
                data : formData,
                success:function(data) {
                    if(data.status){
                        // console.log('111');
                        // $(".msg-success-o").html('<div class="alert alert-success"><ul><li>'+data.message+'</li></ul></div>').show().delay(3000).fadeOut();
                        window.location.replace("{{ url('checkout') }}");
                    }else{
                        // console.log('222');
                        $(".msg-error-o").html('<div class="alert alert-danger"><ul><li>'+data.message+'</li></ul></div>').show().delay(3000).fadeOut();
                    }
                    // load_cart_block();
                }
            });
        }
    </script>
@endsection