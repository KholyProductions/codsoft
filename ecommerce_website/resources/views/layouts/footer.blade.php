<div class="mt_5 d-flex margins" id="footer">
    
    <div id="leftDiv" class="delete_mobile">
        <h2>HARDICA</h2>
        <p style="color:white;" class="mt_1">Your One-Stop Shop for High-Quality Sports Equipment in Egypt. Our products are of the highest quality, designed to help you perform your best and achieve your goals.</p>
        <div class="mt_1 d-flex ">
            <div id="phone_contact_footer"></div>
        </div>
        <div class="mt_1 d-flex ">
            <div id="mail_contact_footer"></div>
        </div>
        <p style="color:white;" class="mt_1">© 2024 Hardica. All Rights Reserved.</p>
    </div>

    <div id="leftDiv" class="delete_pc">
        <h2>HARDICA</h2>
        <p style="color:white;" class="mt_1">Your One-Stop Shop for High-Quality Sports Equipment in Egypt. Our products are of the highest quality, designed to help you perform your best and achieve your goals.</p>
        <div class="mt_3 d-flex ">
            <div id="phone_contact_footer_mobile"></div>
        </div>
        <div class="mt_1 d-flex ">
            <div id="mail_contact_footer_mobile"></div>
        </div>
        <p style="color:white;" class="mt_3">© 2024 Hardica. All Rights Reserved.</p>
    </div>

    <div class="footer_divs delete_mobile">
        
        <h3 class="text-center " style="color:white;">Customer Service</h3>

        <div class="mt_2">
            <a style="color:white;" class="text-center centerRelative" href="{{route('contact.get')}}">Contact Us</a>
        </div>

        <div class="mt_2">
            <a style="color:white;" class="text-center centerRelative">Chat With Agent</a>
        </div>

        <div class="mt_2">
            <a style="color:white;" class="text-center centerRelative" href="{{route('thankyou')}}">Track Order</a>
        </div>

    </div>

    <div class="footer_divs">
        
        <h3 class="text-center " style="color:white;">Useful Links</h3>

        <div class="mt_2">
            <a style="color:white;" class="text-center centerRelative" href="{{route('about')}}">About Us</a>
        </div>

        <div class="mt_2">
            <a style="color:white;" class="text-center centerRelative" >Terms & Conditions</a>
        </div>

        <div class="mt_2">
            <a style="color:white;" class="text-center centerRelative" >Privacy Policy</a>
        </div>

        <div class="mt_2 delete_pc">
            <a style="color:white;" class="text-center centerRelative" href="{{route('contact.get')}}">Contact Us</a>
        </div>

        <div class="mt_2 delete_pc">
            <a style="color:white;" class="text-center centerRelative" >Chat With Agent</a>
        </div>

        <div class="mt_2 delete_pc">
            <a style="color:white;" class="text-center centerRelative"  href="{{route('thankyou')}}">Track Order</a>
        </div>

    </div>

</div>


<script type="text/babel">

    //REACT

    ReactDOM.createRoot(document.getElementById("phone_contact_footer")).render(<Contact text={'+2 01221666623'} img={"{{asset('all_images/phone.png')}}"}/>);
    ReactDOM.createRoot(document.getElementById("mail_contact_footer")).render(<Contact text={'hazemelkholy1@gmail.com'} img={"{{asset('all_images/mail.png')}}"}/>);
    
    ReactDOM.createRoot(document.getElementById("phone_contact_footer_mobile")).render(<Contact text={'+2 01221666623'} img={"{{asset('all_images/phone.png')}}"}/>);
    ReactDOM.createRoot(document.getElementById("mail_contact_footer_mobile")).render(<Contact text={'hazemelkholy1@gmail.com'} img={"{{asset('all_images/mail.png')}}"}/>);

    
    setTimeout(() => {
        if(!is_pc){
            if((footer.offsetHeight + footer.offsetTop) < window.innerHeight){
                footer.style.position = "absolute";
                footer.style.bottom = 0 + "px";
            }
        }
    }, 1000);


</script>