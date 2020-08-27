@extends('layout.master')

@section('content')

<section class="check-out-section payment-m-section">
    <div class="container">
        <div class="row">
            <div class="col check-out-wrap">
                <div class="check-out-desc">
                    <div class="check-out-title">
                        <span>{{ $title }}</span>
                        <h3>Success</h3>
                    </div>
                </div>
                <div class="pay-option-cont">
                    <h4 class="text-success"><i class="fa fa-check"></i> {{ $message }}</h4>
                </div>
            </div>
            <div class="col check-out-wrap">
                <div class="check-out-total order-review-cont">
                    <div class="order-review">
                        <p>Continue With osudpotro</p>
                    </div>
                    <div class="edit-order-cont">
                        <a href="{{ url('/') }}" class="procced-pay-btn">Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('footer_js')
<script>
</script>
@endsection