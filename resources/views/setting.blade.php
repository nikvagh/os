@extends('layout.master')

@section('content')
<section class="profile-section section-padding section-bottom-border">
    <div class="container">
        <div class="row profile-wrap">
            <div class="col profile-cont">
                <div class="profile-tab">
                    <ul class="nav nav-pills" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#setting">
                                <span class="pre-title">settings</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="pill" href="#edit-profile" id="setting_btn_tab">
                                <span class="pre-title">Edit Profile</span>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#notification" id="notification_btn_tab">
                                <span class="pre-title">Notification</span>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </li> -->
                    </ul>
                </div>
            </div>
            <div class="col profile-cont">
                <span class="msg-success-o width-100p"></span>
                <span class="msg-error-o width-100p"></span>

                <div class="tab-content">
                    <div class="tab-pane active" id="edit-profile">
                    </div>
                    <div class="tab-pane" id="notification">
                        
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
            load_edit_profile_block();
        });

        $("#setting_btn_tab").click(function(){
            load_edit_profile_block();
        });

        $("#notification_btn_tab").click(function(){
            load_edit_notification_block();
        });


        function load_edit_profile_block(){
            $.ajax({
                type:'GET',
                url:'/get_edit_profil_block',
                dataType: "json",
                success:function(data) {

                    if(data.re){
                        window.location.href = "{{ url('') }}/"+data.re;
                    }
                    // console.log(data);
                    // $(".msg-error,.msg-success").html('');
                    $("#edit-profile").html(data.view_data);
                }
            });
        }

        function load_edit_notification_block(){
            $.ajax({
                type:'GET',
                url:'/get_edit_notification_block',
                success:function(data) {

                    if(data.re){
                        window.location.href = "{{ url('') }}/"+data.re;
                    }
                    // console.log(data);
                    // $(".msg-error,.msg-success").html('');
                    $("#notification").html(data.view_data);
                }
            });
        }

        $(document).on('click', '#profile-save-btn', function(e) {
            e.preventDefault();
            
            var file = $('#profile_pic')[0].files[0];

            var form = new FormData();
            form.append('user_image', file);
            form.append('name', $('#name').val());
            form.append('address', $('#address').val());
            form.append('area', $('#area').val());
            form.append('mobile', $('#mobile').val());
            form.append('email', $('#email').val());
            form.append('_token', "{{ csrf_token() }}");

            // $.ajax({
            //     url : "upload.php",
            //     type: "POST",
            //     cache: false,
            //     contentType: false,
            //     processData: false,
            //     data : form,
            //     success: function(response){
            //         $('.result').html(response.html)
            //     }
            // });

            $.ajax({
                type:'POST',
                url:'/update_profile',
                dataType: "json",
                cache: false,
                contentType: false,
                processData: false,
                data : form,
                // data: {
                //     "_token": "{{ csrf_token() }}",
                //     "name": name,
                //     "address": address,
                //     "area": area,
                //     "code": code,
                //     "mobile": mobile,
                //     "email": email
                // },
                success:function(data) {
                    console.log(data);

                    if(data.re){
                        window.location.href = "{{ url('') }}/"+data.re;
                    }
                    
                    $(".msg-error-o,.msg-success-o").html('');
                    if(data.error){
                        $(".msg-error-o").html('<div class="alert alert-danger"><ul><li>'+data.error+'</li></ul></div>');
                    }
                    if(data.success){
                        // $("#add_address_frm")[0].reset();
                        // $("#edit-address").modal("hide");
                        if(data.image){
                            $(".header-profile-img").attr('src',data.image);
                        }
                        $(".header-name").html(data.name);

                        $(".msg-success-o").html('<div class="alert alert-success"><ul><li>'+data.success+'</li></ul></div>').show().delay(3000).fadeOut();
                        load_edit_profile_block();
                    }

                    if(data.re){
                        window.location.href = "{{ url('') }}/"+data.re;
                    }

                }
            });
        });

        $(document).on('change', '#notification_check', function(e) {
            e.preventDefault();

            if ($("#notification_check").prop(":checked")) {
                noti_status = 1;
            } else { 
                noti_status = 0;
            } 

            $.ajax({
                type:'POST',
                url:'/update_notification',
                dataType: "json",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "noti_status": noti_status
                },
                success:function(data) {
                    console.log(data);
                    $(".msg-error-o,.msg-success-o").html('');
                    if(data.error){
                        $(".msg-error-o").html('<div class="alert alert-danger"><ul><li>'+data.error+'</li></ul></div>');
                    }
                    if(data.success){
                        // $("#add_address_frm")[0].reset();
                        $("#edit-address").modal("hide");
                        $(".msg-success-o").html('<div class="alert alert-success"><ul><li>'+data.success+'</li></ul></div>').show().delay(3000).fadeOut();
                        load_edit_notification_block();
                    }
                    // $("#msg").html(data.msg);
                }
            });
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    // console.log(e.target.result);
                    // $('#blah').attr('src', e.target.result);
                    // $('#blah').attr('src', e.target.result);
                    $('.img-label-round').css('background', 'url('+e.target.result+')');
                    $('.img-label-round').css('background-size', 'cover');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(document).on('change', '#profile_pic', function() {
            readURL(this);
        });

    </script>
@endsection

