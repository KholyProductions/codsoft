@extends('main')

@section('metas')
    <title>About Us - Get Fit Egypt</title>
    <meta name="description" content="At our store, you'll find a wide range of equipment to choose from, including Gym Supplies, Cardio, Sporting Goods, Accessories, and much more.">
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('css/v_1/home_pc.css?v=1')}}">
    <link rel="stylesheet" href="{{asset('css/v_1/home_mobile.css?v=52')}}">
@endsection

@section('content')

    <div id="about_wallpaper_holder">

        <img class="delete_mobile" src="{{asset('all_images/pexels-823sl-2294403.jpg')}}" />
        <img class="delete_pc" src="{{asset('all_images/pexels-823sl-2294403.jpg')}}" />

        <div id="about_blackDiv"></div>

        <div class="horizontal_vertical_center_absolute" id="about_contentHolder">
            <h1 class="text-center text_xxxl" style="color:white;">About Us</h1>
            <h4 class="text-center" style="color:white;">"We have our fingers on the pulse for the latest sporting goods trends"</h4>
        </div>

    </div>

    <div class="mt_3 margins " id="about_section_1">

        <div id="about_s1_lefDiv">
            <h2 class="text_xxxl">Our Story</h2>
            <p class="mt_2">We pride ourselves on providing top-notch features to enhance your workout experience. We value and implement input from across our company and communities and believe that together, we can achieve greatness.</p>
        </div>

        <div id="about_s1_lrighDiv">

            <p>We offer a wide variety of sports equipment for all types of athletes. Our products are of the highest quality, designed to help you perform your best and achieve your goals.</p>

            <p class="mt_1 ">At our store, you'll find a wide range of equipment to choose from, including Gym Supplies, Cardio, Sporting Goods, Accessories, and much more. We stock products from the world's leading sports brands, so you can be sure that you're getting the best possible quality.</p>

            <p class="mt_1 delete_mobile">With years of experience in the industry, we understand the importance of reliable and safe sporting goods in today's exercise world. From initial consultation to installation and ongoing support, we are here to assist you every step of the way.</p>

        </div>

    </div>

    <img class="delete_pc mt_3" id="about_mobile_image" src="{{asset('all_images/pexels-cesar-galeao-1673528-3253501.jpg')}}" />

    <p class="mt_3 margins delete_pc">We understand how important it is to have the right gear when you're playing sports, which is why we make it our mission to provide the best products to athletes in Egypt. We have a great team of staff members who are knowledgeable about sports and can help you find exactly what you need.</p>

    <p class="mt_1 margins delete_pc">Whether you're a professional athlete or just starting out, we have the gear and expertise to help you succeed. Don't settle for inferior equipment - explore our online store and discover the difference that high-quality sports equipment can make.</p>


    <div class="mt_3 margins" id="about_section_2">
        <div id="about_s2_leftDiv" class="centerText_vertically">
            <img class="" id="about_s2_img" src="{{asset('all_images/pexels-victorfreitas-841130.jpg')}}" />
        </div>
        <div id="about_s2_rightDiv">
            <h2 class="text-center text_xxxl">Vision & Mission</h2>
            <p class="mt_2 text-center">We strive to be the leading provider of innovative workout technologies, empowering individuals, businesses, and communities to have the best of workout and sporting goods</p>
            <p class="mt_2 text-center ">Our mission is to deliver cutting-edge sporting equipments solutions that exceed customer expectations, enabling them to harness the full potential of the fitness world. Through our exceptional customer service, we aim to build long-lasting relationships based on trust and reliability. We are dedicated to creating a positive impact on society by bridging the top sporting equipments. Our mission is to empower individuals and businesses to achieve their workout goals.</p>
            <p class="mt_2 delete_mobile text-center">Explore our website or come to our store today to see our full range of products and to experience the difference that we can make to your sports performance.</p>
        </div>
    </div>

        


@endsection