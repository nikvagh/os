@extends('layout.loginmaster')

@section('content')

<form action="{{url('login_otp_submit')}}" method="post">

    <div class="login-cont">
        <div class="language-op">
            <label class="switch">
                <input type="checkbox" name="language" checked="">
                <span class="slider round">
                    <span class="eng-lag active">EN</span>
                    <span class="bangali-lan"> বাংলা</span>
                </span>
            </label>
        </div>
    </div>

    <div class="login-cont-form">
        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        @if (Session::has('message_e'))
        @include('partials.alert', ['type' => "danger",'message'=> Session::get('message_e') ])
        @endif

        @if (Session::has('message_s'))
        @include('partials.alert', ['type' => "success",'message'=> Session::get('message_s') ])
        @endif


        {{csrf_field()}}
        <div class="signin-signup">
            <a href="#">login</a>
            <span>/</span>
            <a href="#">signup</a>
        </div>
        <div class="signin-input">
            <input type="text" name="mobile" value="{{ old('mobile') }}">
        </div>
        <br />
        <div class="send-otp">
            <!-- <a href="login2.html" class="btn btn-style">Send OTP</a> -->
            <input type="submit" href="" class="btn btn-style btn-block" value="Send OTP">
        </div>
        <div class="otp-input">
            <input id="codeBox1" type="number" maxlength="1" onkeyup="onKeyUpEvent(1, event)" onfocus="onFocusEvent(1)" />
            <input id="codeBox2" type="number" maxlength="1" onkeyup="onKeyUpEvent(2, event)" onfocus="onFocusEvent(2)" />
            <input id="codeBox3" type="number" maxlength="1" onkeyup="onKeyUpEvent(3, event)" onfocus="onFocusEvent(3)" />
            <input id="codeBox4" type="number" maxlength="1" onkeyup="onKeyUpEvent(4, event)" onfocus="onFocusEvent(4)" />
            <input id="codeBox5" type="number" maxlength="1" onkeyup="onKeyUpEvent(5, event)" onfocus="onFocusEvent(5)" />
            <div class="resend-otp">
                <span>Don’t receive the OTP? </span>
                <a href="#">Resend OTP</a>
            </div>
        </div>

    </div>

</form>
@endsection

@section('footer_js')
    <script>
        
    </script>
@endsection
