
<div id="header" >

    <div class="d-flex justify-content-between margins centerText_vertically" id="topHeader">
        <div class="d-flex">
            
            <div  id="phone_contact_header"></div>
            <div class="ml_2 " id="mail_contact_header"></div>

            
        </div>
        <div class="d-flex centerText_vertically">
            <a class="centerText_vertically" ><img class="icons" style="cursor:pointer;" src="{{asset('all_images/youtube.png')}}" /></a>
            <a class="ml_1 centerText_vertically"  ><img class="icons" style="cursor:pointer;" src="{{asset('all_images/facebook.png')}}" /></a>
            <a class="ml_1 centerText_vertically" ><img class="icons" style="cursor:pointer;" src="{{asset('all_images/instagram.png')}}" /></a>
            <a class="ml_1 centerText_vertically" ><img class="icons" style="cursor:pointer;" src="{{asset('all_images/tiktok.png')}}" /></a>
        </div>
    </div>

    <div class="d-flex justify-content-between margins centerText_vertically" id="bottomHeader">
        <a href="{{route('home')}}"><img id="logo" src="{{asset('all_images/logo.png')}}" /></a>
        <div>
            <div class="centerText_vertically">
                <input type="text" class="inputs "  id="header_searchBox" placeholder="Search products"/>
                <img src="{{asset('all_images/search-icon.png')}}" onclick="submit_search()" id="header_searchIcon"/>
            </div>
        </div>
        
        <div class="d-flex  centerText_vertically delete_mobile">
            <a class="menuItemsHolders" href="{{route('products.category', 'gym_equipment')}}">
                <h4>Gym Equipment</h4> 
                <div class="menuLines"></div>
            </a>
            <a class="menuItemsHolders ml_2" href="{{route('products.category', 'cardio')}}">
                <h4>Cardio</h4> 
                <div class="menuLines"></div>
            </a>
            <a class="menuItemsHolders ml_2" href="{{route('products.category', 'sports')}}">
                <h4>Sports</h4> 
                <div class="menuLines"></div>
            </a>
            <a class="menuItemsHolders ml_2" href="{{route('products.category', 'accessories')}}">
                <h4>Accessories</h4> 
                <div class="menuLines"></div>
            </a>
        </div>

    
        <div class="d-flex">

            <a id="cartIconHolder" class="centerText_vertically" href="{{route('account')}}">
                <img class="icons " id="cart_icon" src="{{asset('all_images/account.png')}}" />
            </a>

            <a id="cartIconHolder" class="centerText_vertically ml_2" href="{{route('checkout')}}">
                <img class="icons " id="cart_icon" src="{{asset('all_images/cart-icon.png')}}" />
                <div id="cart_count_div" class="centerText_vertically">{{$cart_count}}</div>
            </a>

        </div>
        

    </div>

    <div class="d-flex margins mt_1   centerText_vertically justify-content-between delete_pc">
            <a class="menuItemsHolders" href="{{route('products.category', 'gym_equipment')}}">
                <h4>Gym Equipment</h4> 
                <div class="menuLines"></div>
            </a>
            <a class="menuItemsHolders ml_2" href="{{route('products.category', 'cardio')}}">
                <h4>Cardio</h4> 
                <div class="menuLines"></div>
            </a>
            <a class="menuItemsHolders ml_2" href="{{route('products.category', 'sports')}}">
                <h4>Sports</h4> 
                <div class="menuLines"></div>
            </a>
            <a class="menuItemsHolders ml_2" href="{{route('products.category', 'accessories')}}">
                <h4>Accessories</h4> 
                <div class="menuLines"></div>
            </a>
        </div>

</div>

<script src="{{asset('react/contact.js?v=2')}}" type="text/babel"></script>

<script type="text/babel">


    //REACT

    ReactDOM.createRoot(document.getElementById("phone_contact_header")).render(<Contact text={'+2 01221666623'} img={"{{asset('all_images/phone.png')}}"}/>);
    ReactDOM.createRoot(document.getElementById("mail_contact_header")).render(<Contact text={'hazemelkholy1@gmail.com'} img={"{{asset('all_images/mail.png')}}"}/>);





    $("#header_searchBox").on('keyup', function (e) {
        if (e.key === 'Enter' || e.keyCode === 13) {
            submit_search();
        }
    });

    function submit_search(){
        let search_val = header_searchBox.value;
        search_val = search_val.toLowerCase();
        let location_str = "{{route('products.search', 'val')}}";
        location_str = location_str.replace('val', search_val);
        window.location = location_str;
    }

</script>