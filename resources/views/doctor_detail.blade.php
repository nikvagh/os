@extends('layout.master')

@section('content')

@include('slider', ['slider' => $slider])

<section class="section-padding doctor-section">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-12">

                <div class="doctor-cont">

                    <span class="msg-success-o width-100p"></span>
                    <span class="msg-error-o width-100p"></span>

                    <div class="doctor-desc">
                        <div class="doctor-img">
                            <div class="doctor-img-inner product-page-img-box @if($doctor->doc_is_online == 1) active-doctor @endif">
                                <a href="#" class="doctor-off-one">
                                    <img src="{{ $doctor->doc_image }}" alt="t1" width="195" height="195">
                                </a>
                                <div class="doctor-name">
                                    <h2>{{ $doctor->doc_name }}</h2>
                                    <a href="#" class="btn request-call @if($doctor->doc_is_online == 1) request-btn @endif">Request for Call</a>
                                    <input type="hidden" name="doc_id" id="doc_id" value="{{$doctor->_id}}">
                                    <!-- <input type="submit" name="req_call" class="btn request-call" value="Request for Call"> -->
                                </div>
                            </div>
                            <div class="doctor-details">
                                <div class="doctor-in-detail">
                                    <h3>Designation</h3>
                                    <span>{{ $doctor->doc_designation }}</span>
                                </div>
                                <div class="doctor-in-detail">
                                    <h3>Experience</h3>
                                    <span>{{$doctor->doc_experience}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="doctor-info">
                            <div class="doctor-in-detail">
                                <h3>Specialty</h3>
                                <span>{{ $doctor->doc_expertise }}</span>
                            </div>
                            <div class="doctor-qualification">
                                <h3>Qualification</h3>
                                <p>{{ $doctor->doc_qualification }}</p>
                                <!-- <p>Royal College of Physicians; MRCP (UK) 2000</p>
                                <p>PHD Imperial College London School of Medicine in 2004</p> -->
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
        $(".request-btn").click(function(e){
            e.preventDefault();
            doc_id = $("#doc_id").val();
            req_callback(doc_id);
        });

        function req_callback(doc_id){

            var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('doc_id', doc_id);

            $.ajax({
                type:'POST',
                url:'{{ url("req_callback") }}',
                dataType: "json",
                cache: false,
                contentType: false,
                processData: false,
                data : formData,
                success:function(data) {
                    // console.log(data);
                    // return false;
                    // console.log('111');

                    if(data.status){
                        //     if(callback == 'buy_more'){
                        //         window.location.href = "{{ url('/') }}";
                        //     }else{
                        //         window.location.href = "{{ url('checkout') }}";
                        //     }
                        $(".msg-success-o").html('<div class="alert alert-success"><ul><li>'+data.message+'</li></ul></div>').show().delay(3000).fadeOut();
                    }else{
                        if(data.re){
                            window.location.href = "{{ url('') }}/"+data.re;
                        }else{
                            $(".msg-error-o").html('<div class="alert alert-warning"><ul><li>'+data.message+'</li></ul></div>').show().delay(3000).fadeOut();
                        }
                    }

                }
            });

        }
    </script>
@endsection