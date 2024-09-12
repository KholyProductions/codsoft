<!DOCTYPE html>

    <head>

        <title>Get Fit Egypt - Maintenance</title>
        <meta name="robots" content="noindex,nofollow">
    
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/x-icon" href="{{asset('all_images/logo.jpg')}}">


        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300&display=swap" rel="stylesheet">
                

        <link rel="stylesheet" href="{{asset('css/v_1/app.css')}}">
        <link rel="stylesheet" href="{{asset('css/v_1/carousel_1.css?v=9')}}">
        <link rel="stylesheet" href="{{asset('css/v_1/reset.css?v=22')}}">
        <link rel="stylesheet" href="{{asset('css/v_1/mainCss.css?v=22')}}">
        <link rel="stylesheet" href="{{asset('css/v_1/globals_pc.css?v=7')}}">
        <link rel="stylesheet" href="{{asset('css/v_1/globals_mobile.css?v=20')}}">
        <link rel="stylesheet" href="{{asset('css/v_1/home_pc.css?v=13')}}">
        <link rel="stylesheet" href="{{asset('css/v_1/home_mobile.css?v=10')}}">
        @yield('css')
        

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>

            
        <script src="https://unpkg.com/react@18/umd/react.development.js" crossorigin></script>
        <script src="https://unpkg.com/react-dom@18/umd/react-dom.development.js" crossorigin></script>
        <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>

        <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
        <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <style type="text/css">
            
            @media only screen and (min-device-width:1024px){
                body{
                    background-image: url("{{asset('all_images/wallpaper-1.jpg')}}");
                    background-repeat: no-repeat;
                    background-size: 100% auto;
                    height: 100vh;
                }
            }

            @media only screen and (max-device-width:1023px){
                h1{
                    font-size: 6vw !important;
                }
                body{
                    background-image: url("{{asset('all_images/wallpaper-2.jpg')}}");
                    background-repeat: no-repeat;
                    background-size: auto 100%;
                    height: 100vh;
                }
            }
            

        </style>


    </head>

    <body>

        <div id="maintenanceContainer" class="vertical_center" >
            <div class="">
                <div>
                   <h1 class=" text-center" style="color:white;">Maintenance</h1>
                    <h3 class="mt_1 text-center"  style="color:white;">We will be back soon</h3>

                    <div class="mt_4 ">
                        <div class="w-50 centerRelative w_100">
                            <video width="100%" height="auto" controls>
                              <source src="{{asset('videos/homepage-getfit-video.mp4')}}" type="video/mp4">
                            </video>
                        </div>
                    </div> 
                </div>
            </div>
                

            
        </div>
        


    </body>



</html>