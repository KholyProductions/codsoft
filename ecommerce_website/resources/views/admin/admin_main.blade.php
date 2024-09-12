<!DOCTYPE html>

    <head>

        <title>Admin - Hardica</title>
        <meta name="robots" content="noindex,nofollow">
        <link rel="icon" href="{{asset('all_images/logo.png')}}">
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap" rel="stylesheet">
                

        <link rel="stylesheet" href="{{asset('css/v_1/app.css')}}">
        <link rel="stylesheet" href="{{asset('css/v_1/reset.css?v=5')}}">
        <link rel="stylesheet" href="{{asset('css/v_1/mainCss.css?v=24')}}">
        <link rel="stylesheet" href="{{asset('css/v_1/globals_pc.css?v=3')}}">
        <link rel="stylesheet" href="{{asset('css/v_1/globals_mobile.css?v=18')}}">
        <link rel="stylesheet" href="{{asset('css/v_1/carousel_1.css?v=6')}}">
        <link rel="stylesheet" href="{{asset('css/v_1/admin.css?v=10')}}">
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

        


        @include('admin.admin_header')
        @yield('content')



    </body>



</html>