@extends('main')

@section('metas')
    <meta name="robots" content="noindex,nofollow">
    <title>Payment - Get Fit Egypt</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('css/v_1/home_pc.css?v=1')}}">
    <link rel="stylesheet" href="{{asset('css/v_1/home_mobile.css?v=4')}}">
@endsection


@section('content')

    <h1 class="mt_4 text-center">Payment</h1>
    @if($method == 'visa')
        <h3 class="mt_1 text-center">Pay through PayPal, VISA</h3>

        <div class="margins mt_3">
            @include('components.payment_visa')
        </div>
    @else
        <h3 class="mt_1 text-center">Pay through Vodafone Cash, Orange Cash, Etisalat Cash</h3>
        
        <div class="margins mt_3">
            @include('components.payment_mobile')
        </div>
    @endif




@endsection