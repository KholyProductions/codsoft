<!DOCTYPE html>

    <head>

        <title>Admin - Get Fit Egypt</title>
        <meta name="robots" content="noindex,nofollow">
        <link rel="icon" href="{{asset('all_images/logo.jpg')}}">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap" rel="stylesheet">
                

        <link rel="stylesheet" href="{{asset('css/v_1/app.css')}}">
        <link rel="stylesheet" href="{{asset('css/v_1/reset.css?v=5')}}">
        <link rel="stylesheet" href="{{asset('css/v_1/mainCss.css?v=24')}}">
        <link rel="stylesheet" href="{{asset('css/v_1/globals_pc.css?v=3')}}">
        <link rel="stylesheet" href="{{asset('css/v_1/globals_mobile.css?v=17')}}">
        <link rel="stylesheet" href="{{asset('css/v_1/carousel_1.css?v=6')}}">
        <link rel="stylesheet" href="{{asset('css/v_1/admin.css?v=9')}}">
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

        <div id="admin_loginMainContainer">
            <img id="admin_image" src="{{asset('all_images/wallpaper-1.jpg')}}" />

            <div id="loginMainContainer" class="horizontal_vertical_center_absolute">

                <img class="centerRelative" id="login_logo" src="{{asset('all_images/logo.jpg')}}"/>

                <h1 class="text-center mt_2">Admin Login</h1>

                <form method="post" action="{{route('admin.post')}}" class="w-100 mt_2">
                    @csrf

                    <h4>Username</h4>
                    <input type="text" placeholder="Enter your username" class="inputs w-100 " name="username_input" />
                    
                    <h4 class="mt_2">Password</h4>
                    <input type="password" placeholder="Enter your password" class="inputs w-100 " name="password_input" />

                    <input type="submit" class="mt_2 centerRelative btns btns_t" value="Login"/>

                </form> 
            </div>
        </div>
        
        


        



    </body>



</html>