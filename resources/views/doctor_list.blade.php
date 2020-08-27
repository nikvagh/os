@extends('layout.master')

@section('content')

@include('slider', ['slider' => $slider])

<section class="section-padding doctor-section">
    <div class="container">
        <div class="row">
            <div class="col">
                <!-- <div class="section-padding section-border"> -->

                    <div class="other-section-title">
                        <h2>
                            <span class="title1">Online</span>
                            <span class="title2">Doctors</span>
                        </h2>
                    </div>
                    
                    @if(isset($page_data))
                        <div class="owl-carousel owl-theme team-testimonial" id="team-testimonial">
                            @foreach ($page_data as $key1=>$val1)
                                {{-- @if($val1->in_home_screen == 1) --}}
                                    <div class="item">
                                        <div class="doctor-team">
                                            <a href="{{ url('doctor_details/'.$val1->_id) }}">
                                                <img class="img-fluid" src="{{$val1->doc_image}}">
                                            </a>
                                            <h6>{{$val1->doc_name}}</h6>
                                            <p>{{$val1->doc_designation}}</p>
                                        </div>
                                    </div>
                                {{-- @endif --}}
                            @endforeach
                        </div>
                    @else
                        <div class="section-padding">
                            <div class="other-section-title">

                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <ul>
                                        <li> <i class="fa fa-exclamation-circle"></i> No doctors found</b></li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    @endif

                <!-- </div> -->
            </div>
        </div>
    </div>
</section>

@endsection

@section('footer_js')
    
@endsection