<!DOCTYPE html>

    <head>

        @yield('metas')
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta property="og:image" content="{{asset('all_images/logo.png?v=2')}}" />
        <link rel="icon" type="image/x-icon" href="{{asset('all_images/logo.png?v=2')}}">
        <meta name="keywords" content="sporting workout equipment egypt">  


        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap" rel="stylesheet">
                

        <link rel="stylesheet" href="{{asset('css/v_1/app.css')}}">
        <link rel="stylesheet" href="{{asset('css/v_1/carousel_1.css?v=10')}}">
        <link rel="stylesheet" href="{{asset('css/v_1/reset.css?v=2')}}">
        <link rel="stylesheet" href="{{asset('css/v_1/mainCss.css?v=23')}}">
        <link rel="stylesheet" href="{{asset('css/v_1/globals_pc.css?v=14')}}">
        <link rel="stylesheet" href="{{asset('css/v_1/globals_mobile.css?v=14')}}">
        <link rel="stylesheet" href="{{asset('css/v_1/site_pc.css?v=4')}}">
        <link rel="stylesheet" href="{{asset('css/v_1/site_mobile.css?v=63')}}">
        @yield('css')
        

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>

            
        <script src="https://unpkg.com/react@18/umd/react.development.js" crossorigin></script>
        <script src="https://unpkg.com/react-dom@18/umd/react-dom.development.js" crossorigin></script>
        <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>



        <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
        <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />

        <meta name="csrf-token" content="{{ csrf_token() }}">



    </head>

    <body>

        <script>var is_pc = screen.width > screen.height && screen.width > 1023;</script>

        @include('layouts.header')
        @yield('content')
        @include('layouts.footer')
        @include('components.alert')


    </body>



</html>