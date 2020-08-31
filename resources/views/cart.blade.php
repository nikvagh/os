@extends('layout.master')

@section('content')
<section class="cart-section">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="cart-cont">
                    <div class="check-out-title">
                        <h3>Cart</h3>
                    </div>
                    <div class="cart-wrap">

                        @if (Session::has('message_s'))
                            @include('partials.alert', ['type' => "success",'message'=> Session::get('message_s') ])
                        @endif

                        @if (Session::has('message_e'))
                            @include('partials.alert', ['type' => "danger",'message'=> Session::get('message_e') ])
                        @endif
                        
                        <span class="msg-success-o width-100p"></span>
                        <span class="msg-error-o width-100p"></span>

                        <div id="cart_box">
                        </div>

                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>

@endsection

@section('footer_js')
    <script>
        // order-delivery-detail
        $(document).ready(function(){
            load_cart_block();
        });

        function load_cart_block(){
            $.ajax({
                type:'GET',
                url:'{{ url("load_cart_block") }}',
                dataType: "json",
                success:function(data) {

                    if(data.re){
                        window.location.href = "{{ url('') }}/"+data.re;
                    }

                    // console.log(data);
                    $("#cart_box").html(data.view_data);
                }
            });
        }

        $(document).on('click', '.minus-btn', function(e) {
            e.preventDefault();
            var $this = $(this);
            var $thisAry = $this.attr('id').split('-');
            var $input = $("#qty_"+$thisAry[2]+"_"+$thisAry[3]);
            var value = parseInt($input.val());

            if (value > 1) {
                value = value - 1;
            } else {
                value = 0;
            }
            $input.val(value);
            update_cart($thisAry[2],$thisAry[4]);
        });

        $(document).on('click', '.plus-btn', function(e) {
            e.preventDefault();
            var $this = $(this);
            var $thisAry = $this.attr('id').split('-');
            var $input = $("#qty_"+$thisAry[2]+"_"+$thisAry[3]);
            var value = parseInt($input.val());

            if (value < 100) {
                value = value + 1;
            } else {
                value = 2;
            }
            $input.val(value);
            update_cart($thisAry[2],$thisAry[4]);
        });

        function update_cart(id,item_type){
            // is_zero = check_for_not_all_zero();
            // if(is_zero == "Y"){
            //     $(".msg-error-o").html('<div class="alert alert-danger"><ul><li>Add atleast one qty more than zero</li></ul></div>').show().delay(3000).fadeOut();
            //     return false;
            // }

            var form = $("#cart_frm")[0];
            var formData = new FormData(form);
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('item_id', id);
            formData.append('item_type', item_type);

            $.ajax({
                type:'POST',
                url:'{{ url("update_cart") }}',
                dataType: "json",
                cache: false,
                contentType: false,
                processData: false,
                data : formData,
                success:function(data) {

                    // console.log("111");
                    // console.log(data);

                    if(data.re){
                        window.location.href = "{{ url('') }}/"+data.re;
                    }
                    
                    if(data.status){
                        // console.log('111');
                        $(".msg-success-o").html('<div class="alert alert-success"><ul><li>'+data.message+'</li></ul></div>').show().delay(3000).fadeOut();
                    }else{
                        // console.log('222');
                        $(".msg-error-o").html('<div class="alert alert-danger"><ul><li>'+data.message+'</li></ul></div>').show().delay(3000).fadeOut();
                    }
                    load_cart_block();
                }
            });
        }

    </script>
@endsection

