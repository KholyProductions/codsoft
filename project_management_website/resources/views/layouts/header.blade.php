<div class="margins d-flex justify-content-between centerText_vertically delete_mobile" id="header">

    <a href="{{route('home')}}"><img id="logo" src="{{asset('all_images/logo.png')}}" /></a>

    <div class="d-flex centerText_vertically">
        <a class="menuItems" href="{{route('home')}}">Home</a>
        @if($loggedIn !== 'true')
            <a class="menuItems ml_3" href="{{route('login')}}">Tasks & Projects</a>
        @else
            <a class="menuItems ml_3" href="{{route('account')}}">Tasks & Projects</a>
        @endif
        <a class="menuItems ml_3" href="{{route('about')}}">About Us</a>
        <a class="menuItems ml_3" href="{{route('contact')}}">Contact Us</a>
    </div>

    <div class="d-flex centerText_vertically">
        @if($loggedIn !== 'true')
            <a href="{{route('login')}}" class="centerText_vertically"><img class="icons" src="{{asset('all_images/account.png')}}" /></a>
            <a class="btns btns_black ml_2" href="{{route('login')}}">Start for free</a>
        @else
            <a href="{{route('account')}}" class="centerText_vertically"><img class="icons" src="{{asset('all_images/account.png')}}" /></a>
            <a class="btns btns_black ml_2" href="{{route('account')}}">Start for free</a>
        @endif
            
    </div>

</div>


<div class="margins d-flex justify-content-between centerText_vertically delete_pc" id="header">

    <a href="{{route('home')}}"><img id="logo" src="{{asset('all_images/logo.png')}}" /></a>

    <div class="d-flex centerText_vertically">
        <a class="menuItems" href="{{route('home')}}">Home</a>
        @if($loggedIn !== 'true')
            <a class="menuItems ml_3" href="{{route('login')}}">Tasks & Projects</a>
        @else
            <a class="menuItems ml_3" href="{{route('account')}}">Tasks & Projects</a>
        @endif
        <a class="menuItems ml_3" href="{{route('about')}}">About Us</a>
    </div>

    <div class="d-flex centerText_vertically">
        @if($loggedIn !== 'true')
            <a href="{{route('login')}}" class="centerText_vertically"><img class="icons" src="{{asset('all_images/account.png')}}" /></a>
        @else
            <a href="{{route('account')}}" class="centerText_vertically"><img class="icons" src="{{asset('all_images/account.png')}}" /></a>
        @endif
            
    </div>

</div>