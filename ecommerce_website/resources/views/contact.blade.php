@extends('main')

@section('metas')
    <title>Contact Us - Get Fit Egypt</title>
    <meta name="description" content="If you have any questions, contact us and we will reply as soon as possible. Share with us your thoughts and our team will direct you to the right person">
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('css/v_1/home_pc.css?v=51')}}">
    <link rel="stylesheet" href="{{asset('css/v_1/home_mobile.css?v=57')}}">
@endsection

@section('content')

    <div id="contactMainImage_holder">
        <img id="contactMainImage" src="{{asset('all_images/wallpaper-2.jpg')}}" />
    </div>
    

    <div class="mt_4 margins  justify-content-between" id="contactContainer">

        

        <div id="contact_rightDiv">
            <h1 class="text-center">Contact Us</h1>
            <form method="post" class="w-100" action="{{route('contact.post')}}">
                @csrf

                <label class="mt_2">Name:</label>
                <input type="text" name="name_input" placeholder="Enter your name" class="inputs w-100" />

                <label class="mt_1">Email:</label>
                <input type="email" name="email_input"  placeholder="Enter your email" class="inputs w-100" />

                <label class="mt_1">Phone:</label>
                <input type="phone" name="phone_input"  placeholder="Enter your phone" class="inputs w-100" />
                
                <label class="mt_1">Message:</label>
                <textarea type="text" name="message_input"  id="message_input" placeholder="Type your message" class="inputs w-100"></textarea>

                <input type="submit" id="sendMsg_btn" value="Send Message" class="mt_2 btns btns_t centerRelative"style="border: 1px solid grey !important;" />
            </form>
        </div>


        <div id="contact_leftDiv">
            <div class="d-flex">
                <div id="verticalLine"></div>
                <h2>To make requests for further information <span style="color:#ffc702; font-weight:700;">contact us</span> via our social channels</h2>
            </div>
            <h4 class="mt_2">Your One-Stop Shop for High-Quality Sports Equipment in Egypt. Our products are of the highest quality, designed to help you perform your best and achieve your goals.</h4>
            <h4 class="mt_2">If you have any questions, contact us and we will reply as soon as possible. Share with us your thoughts and our team will direct you to the right person</h4>
            <div class="d-flex mt_2 ">
                <a href="https://www.youtube.com/@getfit-egypt" target="_blank" class="centerText_vertically"><img class="icons_large" style="cursor:pointer;" src="{{asset('all_images/youtube.png')}}" /></a>
                <a class="ml_1 centerText_vertically" href="https://www.facebook.com/getfit.store.egypt" target="_blank"><img class="icons_large" style="cursor:pointer;" src="{{asset('all_images/facebook.png')}}" /></a>
                <a class="ml_1 centerText_vertically"  href="https://www.instagram.com/getfit.egypt/" target="_blank"><img class="icons_large" style="cursor:pointer;" src="{{asset('all_images/instagram.png')}}" /></a>
                <a href="https://www.tiktok.com/@getfit_egypt"  target="_blank" class="ml_1 centerText_vertically"><img class="icons_large" style="cursor:pointer;" src="{{asset('all_images/tiktok.png')}}" /></a>
            </div>
        </div>



    </div>



    <script>

        setTimeout(() => {
            contact_leftDiv.style.opacity = 1;
            contact_leftDiv.style.left = 0;

            contact_rightDiv.style.opacity = 1;
            contact_rightDiv.style.top = 0;
        }, 500);
        

        var msg = "{{$msg}}";

        setTimeout(() => {
            if(msg == 'success'){
                showTopAlert("Thank you", "We have received your message and will reply as soon as possible");
            }
            if(msg == 'fail'){
                showTopAlert("Invalid information", "Please fill all required fields");
            }
        }, 1000);
        



    </script>





@endsection