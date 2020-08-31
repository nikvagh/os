@extends('layout.master')

@section('content')
<section class="contact-p-section">
    <div class="contact-us-map">
        <div class="gmap_canvas">
            <iframe id="gmap_canvas" src="https://maps.google.com/maps?q=university%20of%20san%20francisco&t=&z=17&ie=UTF8&iwloc=&output=embed"></iframe>
            <div class="contact-cont">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                            <div class="contact-desc">
                                <div class="contact-title-desc">
                                    <h1>Get In Touch</h1>
                                    <p class="cont-desc">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="contact-us-form">
                                <div class="msg-info">
                                    <div class="msg-info-d">
                                        <span>Send Us Message</span>
                                        <a href="#"><img src="image/email-icon.png" alt="email-icon"></a>
                                    </div>
                                    <div class="contact-form">
                                        <form>
                                            <div class="form-input">
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input type="text" placeholder="Name">
                                                </div>
                                                <div class="form-group">
                                                    <label>email</label>
                                                    <input type="email" placeholder="Email">
                                                </div>
                                                <div class="form-group">
                                                    <label>contact number</label>
                                                    <input type="text" placeholder="Number">
                                                </div>
                                            </div>
                                            <div class="form-group form-text-area">
                                                <label>Message</label>
                                                <textarea> </textarea>
                                            </div>
                                            <div class="cont-send">
                                                <a href="#" class="btn btn-style">send</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="cont-info">
                                    <div class="msg-info-d">
                                        <span>Contact Infomation</span>
                                    </div>
                                    <div class="cont-mobile">
                                        <ul>
                                            <li><a href="#"><img src="{{ url('image/phone-icon.png') }}" alt="phone-icon"><span>+887656984344</span></a></li>
                                            <li><a href="#"><img src="{{ url('image/phone-icon.png') }}" alt="phone-icon"><span>+887656984344</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
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

        // $(document).on('click', '.minus-btn', function(e) {
        //     e.preventDefault();
        //     var $this = $(this);
        //     var $thisAry = $this.attr('id').split('-');
        //     var $input = $("#qty_"+$thisAry[2]+"_"+$thisAry[3]);
        //     var value = parseInt($input.val());

        //     if (value > 1) {
        //         value = value - 1;
        //     } else {
        //         value = 0;
        //     }
        //     $input.val(value);
        //     update_cart($thisAry[2],$thisAry[4]);
        // });

        // $(document).on('click', '.plus-btn', function(e) {
        //     e.preventDefault();
        //     var $this = $(this);
        //     var $thisAry = $this.attr('id').split('-');
        //     var $input = $("#qty_"+$thisAry[2]+"_"+$thisAry[3]);
        //     var value = parseInt($input.val());

        //     if (value < 100) {
        //         value = value + 1;
        //     } else {
        //         value = 2;
        //     }
        //     $input.val(value);
        //     update_cart($thisAry[2],$thisAry[4]);
        // });

        // function update_cart(id,item_type){
        //     // is_zero = check_for_not_all_zero();
        //     // if(is_zero == "Y"){
        //     //     $(".msg-error-o").html('<div class="alert alert-danger"><ul><li>Add atleast one qty more than zero</li></ul></div>').show().delay(3000).fadeOut();
        //     //     return false;
        //     // }

        //     var form = $("#cart_frm")[0];
        //     var formData = new FormData(form);
        //     formData.append('_token', "{{ csrf_token() }}");
        //     formData.append('item_id', id);
        //     formData.append('item_type', item_type);

        //     $.ajax({
        //         type:'POST',
        //         url:'{{ url("update_cart") }}',
        //         dataType: "json",
        //         cache: false,
        //         contentType: false,
        //         processData: false,
        //         data : formData,
        //         success:function(data) {
        //             if(data.status){
        //                 // console.log('111');
        //                 $(".msg-success-o").html('<div class="alert alert-success"><ul><li>'+data.message+'</li></ul></div>').show().delay(3000).fadeOut();
        //             }else{
        //                 // console.log('222');
        //                 $(".msg-error-o").html('<div class="alert alert-danger"><ul><li>'+data.message+'</li></ul></div>').show().delay(3000).fadeOut();
        //             }
        //             load_cart_block();
        //         }
        //     });
        // }
    </script>
@endsection

