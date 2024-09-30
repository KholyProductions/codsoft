<section id="footer" class="mt_4 margins d-flex">

    <div id="leftDiv">
        <div class="text_3xl">Astra</div>
        <div class="mt_2 lines"></div>
        <div class="mt_2 d-flex">
            <img class="icons centerText_vertically" src="{{asset('all_images/location-icon.png')}}" />
            <p class="ml_1 centerText_vertically">Heliopolis. Cairo, Egypt</p>
        </div>
        <div class="mt_1 d-flex">
            <img class="icons centerText_vertically" src="{{asset('all_images/mail-icon.png')}}" />
            <p class="ml_1 centerText_vertically">info@astra.com</p>
        </div>
        <div class="mt_1 d-flex">
            <img class="icons centerText_vertically" src="{{asset('all_images/phone-icon.png')}}" />
            <p class="ml_1 centerText_vertically">+2 01221622223</p>
        </div>
        
        <p class="mt_3">© 2024 Astra. All Rights Reserved.</p>
    </div>

    <div>

        <h4 class="text-center" style="font-weight:800;">Useful Links</h4>

        <div class="mt_3">

            <div class="text-center "><a href="{{route('login')}}">Login / Register</a></div>
            @if($loggedIn == 'true')
                <div class="text-center mt_2 delete_mobile"><a  href="{{route('account')}}">Create a Project</a></div>
            @else
                <div class="text-center mt_2 delete_mobile"><a  href="{{route('login')}}">Create a Project</a></div>
            @endif
            <div class="text-center mt_2"><a href="{{route('contact')}}">Contact Us</a></div>
            <div class="text-center mt_2  delete_pc"><a href="{{route('about')}}">Who We Are</a></div>
            <div class="text-center delete_pc mt_2"><a >Terms & Conditions</a></div>
            <div class="text-center delete_pc mt_2"><a >Privacy Policy</a></div>

        </div>

    </div>

    <div class="delete_mobile">

        <h4 class="text-center" style="font-weight:800;">About Us</h4>

        <div class="mt_3">

            <div class="text-center "><a href="{{route('about')}}">Who We Are</a></div>
            <div class="text-center mt_2"><a >Terms & Conditions</a></div>
            <div class="text-center mt_2"><a >Privacy Policy</a></div>

            <div class="mt_4 d-flex">

                <a ><img src="{{asset('all_images/youtube-black.png')}}" class="socialIcons" /></a>
                <a  class="ml_2"><img src="{{asset('all_images/instagram-black.png')}}" class="socialIcons " /></a>
                <a  class="ml_2"><img src="{{asset('all_images/facebook-black.png')}}" class="socialIcons " /></a>

            </div>

        </div>

    </div>

</section>