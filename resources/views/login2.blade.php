@extends('layout.loginmaster')

@section('content')
    <div class="login-cont">
        <div class="language-op">
            <label class="switch">
                <input type="checkbox" @if($language == 'en') checked @endif name="language">
                <span class="slider round">
                    <span class="eng-lag">EN</span>
                    <span class="bangali-lan"> বাংলা</span>
                </span>
            </label>
        </div>
    </div>

    <div class="login-cont-form">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        @if (Session::has('message_s'))
            @php
                $test = "111";
            @endphp
            @include('partials.alert', ['type' => "success",'message'=> Session::get('message_s') ])
        @endif

        @if (Session::has('message_e'))
            @include('partials.alert', ['type' => "danger",'message'=> Session::get('message_e') ])
        @endif

        <form action="{{url('login_otp_submit')}}" method="post" id="send_otp_frm">
            {{csrf_field()}}
            <div class="signin-signup">
                <a href="#">login</a>
                <span>/</span>
                <a href="#">signup</a>
            </div>
            <div class="signin-input">
                <input type="text" name="mobile" value="{{$mobile}}" readonly>
            </div>
            <br/>
            <div class="send-otp">
                <!-- <a href="login2.html" class="btn btn-style">Send OTP</a> -->
                <input type="submit" href="" class="btn btn-style btn-block" value="Send OTP">
            </div>
        </form>

        <form action="{{url('login_otp_verify')}}" method="post">
            {{csrf_field()}}
            <input type="hidden" name="mobile" value="{{$mobile}}"/>
            <div class="otp-input">
                <input id="codeBox1" class="otp_text" type="number" name="otp[]" maxlength="1" onkeyup="onKeyUpEvent(1, event)" onfocus="onFocusEvent(1)"/>
                <input id="codeBox2" class="otp_text" type="number" name="otp[]" maxlength="1" onkeyup="onKeyUpEvent(2, event)" onfocus="onFocusEvent(2)"/>
                <input id="codeBox3" class="otp_text" type="number" name="otp[]" maxlength="1" onkeyup="onKeyUpEvent(3, event)" onfocus="onFocusEvent(3)"/>
                <input id="codeBox4" class="otp_text" type="number" name="otp[]" maxlength="1" onkeyup="onKeyUpEvent(4, event)" onfocus="onFocusEvent(4)"/>
                <input id="codeBox5" class="otp_text" type="number" name="otp[]" maxlength="1" onkeyup="onKeyUpEvent(5, event)" onfocus="onFocusEvent(5)"/>
                <div class="resend-otp">
                    <span>Don’t receive the OTP? </span>
                    <a href="#" id="resend_otp">Resend OTP</a>   
                </div>
                <div class="continue-button">
                    <input type="submit" name="submit" class="btn btn-style btn-block" value="Continue">
                </div>
            </div>
        </form>
    </div>
@endsection

@section('footer_js')
    <script>
        $("#resend_otp").click(function(e){
            e.preventDefault();
            // alert('111');
            $("#send_otp_frm").submit();
        });

        $(".otp_text").keyup(function(e){
            var value = $(this).val();
            var len = value.length;
            // console.log(value);
            // console.log(len);
            // return false;
            if(len > 1){
                // console.log(len);
                var lastChar = value[value.length -1];
                $(this).val(lastChar);
            }
        });

    </script>
@endsection