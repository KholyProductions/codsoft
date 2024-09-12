@extends('main')

@section('metas')
    <title>Hardica - Your One-Stop Shop for High-Quality Sports Equipment in Egypt.</title>
    <meta name="description" content="We offer a wide variety of sports equipment for all types of athletes. Our products are of the highest quality, designed to help you perform your best and achieve your goals.">
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('css/v_1/home_pc.css?v=1')}}">
    <link rel="stylesheet" href="{{asset('css/v_1/home_mobile.css?v=51')}}">
@endsection

@section('content')

    <div id="section_1">
        @foreach($all_wallpapers as $wallpaper)
            <img class="wallpapers" src="{{asset('all_images')}}/{{$wallpaper->image}}" />
        @endforeach

        <div class="vertical_center delete_mobile" id="s1_content_holder">

            <h1 id="getfit_word" style="color:white !important;">HARDICA</h1>
            <h3 class="mt_1" style="color:white;">Your One-Stop Shop for High-Quality Sports Equipment in Egypt. Our products are of the highest quality, designed to help you perform your best and achieve your goals.</h3>
            
            <div class="mt_2 d-flex ">
                <a href="{{route('products.all')}}" class="btns btns_t_w " >Explore Products</a>
                <a class="btns btns_underline_w ml_2" >Speak To Agent</a>
            </div>
           

        </div>

        <div class="horizontal_vertical_center_absolute delete_pc" id="s1_content_holder_mobile">

            <h1 id="getfit_word" style="color:white !important;" class="text-center">HARDICA</h1>
            <h3 class="mt_1 text-center" style="color:white;">Your One-Stop Shop for High-Quality Sports Equipment in Egypt. Our products are of the highest quality, designed to help you perform your best and achieve your goals.</h3>
            
            
            <div class="mt_2 d-flex centerRelative " style="width:fit-content;">
                <a class="btns btns_t_w" >Speak To Agent</a>
                <a href="{{route('products.all')}}" class="btns btns_t_w ml_2" >View Products</a>
            </div>

        </div>
        
    </div>


    <div class="margins mt_4">

        <div class="d-flex justify-content-between">
            <h3>Top Selling</h3>
            <a class="btns btns_t" href="{{route('products.top')}}">View All</a>
        </div>
        <div class="mt_2">
            @include('components.carousel_topselling')
        </div>

    </div>


    <div class="margins mt_4">

        <div class="d-flex justify-content-between">
            <h3>New Arrivals</h3>
            <a class="btns btns_t" href="{{route('products.new')}}">View All</a>
        </div>
        <div class="mt_2">
            @include('components.carousel_new')
        </div>

    </div>


    <div style="width:100vw;" class="mt_4">
        <video width="100%" height="auto"  autoplay loop muted>
          <source src="{{asset('videos/homepage-getfit-video.mp4')}}" type="video/mp4">
        </video>
    </div>

    <div class="margins mt_4">

        <div class="d-flex justify-content-between">
            <h3>Cardio</h3>
            <a class="btns btns_t" href="{{route('products.category', 'cardio')}}">View All</a>
        </div>
        <div class="mt_2">
            @include('components.carousel_cardio')
        </div>

    </div>

    <div class="margins mt_4">

        <div class="d-flex justify-content-between">
            <h3>Gym Equipment</h3>
            <a class="btns btns_t" href="{{route('products.category', 'gym_equipment')}}">View All</a>
        </div>
        <div class="mt_2">
            @include('components.carousel_gym')
        </div>

    </div>

    <div class="margins mt_4">

        <div class="d-flex justify-content-between">
            <h3>Accessories</h3>
            <a class="btns btns_t" href="{{route('products.category', 'accessories')}}">View All</a>
        </div>
        <div class="mt_2">
            @include('components.carousel_accessories')
        </div>

    </div>

    <div class="mt_5 margins justify-content-between" id="section_8">

        <div class="s8_holders"></div>
        <div class="s8_holders"></div>
        <div class="s8_holders"></div>

    </div>


    <script src="{{asset('react/features.js?v=1')}}" type="text/babel"></script>


    <script type="text/babel" >

        //REACT

        ReactDOM.createRoot(document.querySelectorAll(".s8_holders")[0]).render(<Features title={"Fast & safe delivery"} description={"Our company makes delivery all over the country"} img={"{{asset('all_images/shipping-icon.png')}}"}/>);
        ReactDOM.createRoot(document.querySelectorAll(".s8_holders")[1]).render(<Features title={"Quality assurance"} description={"We offer only those goods, in which quality we are sure"} img={"{{asset('all_images/quality-icon.png')}}"}/>);
        ReactDOM.createRoot(document.querySelectorAll(".s8_holders")[2]).render(<Features title={"Returns within 14 days"} description={"You have 14 days to test your purchase"} img={"{{asset('all_images/returns-icon.png')}}"}/>);



    </script>


    <script >


        



        var wallpapers = document.querySelectorAll(".wallpapers");
        var wallpaper_position = -1;

        changeWallpaper();

        setTimeout(() => {
                show_s1_content();
            }, 2000);
        


        function show_s1_content(){
            s1_content_holder.style.opacity = 1;
            s1_content_holder.style.left = "7vw";

            s1_content_holder_mobile.style.opacity = 1;
        }
        
        function changeWallpaper(){

            if(wallpaper_position > -1){
                wallpapers[wallpaper_position].style.opacity = 0;
            }
            wallpaper_position++;
            if(wallpaper_position == wallpapers.length){
                wallpaper_position = 0;
            }
            wallpapers[wallpaper_position].style.opacity = 1;

            setTimeout(() => {
                changeWallpaper();
            }, 4000);

        }

    </script>

@endsection