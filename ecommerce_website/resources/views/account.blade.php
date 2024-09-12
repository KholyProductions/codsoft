@extends('main')

@section('css')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/3.1.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="{{asset('css/v_1/tabs.css')}}" />
    <link rel="stylesheet" href="{{asset('css/v_1/account_pc.css')}}" />
    <link rel="stylesheet" href="{{asset('css/v_1/account_mobile.css?v=11')}}" />
@endsection

@section('content')

    <h1 class="text-center mt_4">Account Management</h1>

    <div class="margins mt_4">

        @include('layouts.tabs')

    </div>


@endsection