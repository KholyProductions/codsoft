@extends('main')

@section('metas')
    <title>Register - Hardica</title>
    <meta name="description" content="Register at our store and keep updated with our latest news">
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('css/v_1/home_pc.css?v=1')}}">
    <link rel="stylesheet" href="{{asset('css/v_1/home_mobile.css?v=11')}}">
@endsection

@section('content')

<div id="mainContainer">

    <div id="loginContainer" class=" centerRelative">

        <h1 class="text-center">Register</h1>

        <div id="form" class="centerRelative w-100 w_100 mt_2">

            <h4>Name:</h4>
            <input type="name" id="name_input" class="inputs w-100" placeholder="Enter your name"/>
            
            <h4 class="mt_2">Email:</h4>
            <input type="email" id="email_input" class="inputs w-100" placeholder="Enter your email"/>

            <h4 class="mt_2">Phone Number:</h4>
            <input type="phone" id="phone_input" class="inputs w-100" placeholder="Enter your phone number"/>
            
            <h4 class="mt_2">Password:</h4>
            <input type="password" id="password_input" class="inputs w-100" placeholder="Enter your password"/>

            <h4 class="mt_2">City:</h4>
            <input type="text" id="city_input" class="inputs w-100" placeholder="Enter your city"/>
            
            <h4 class="mt_2">Address:</h4>
            <input type="text" id="address_input" class="inputs w-100" placeholder="Enter your address"/>

            <div id="register_btn" class="centerRelative btns btns_t mt_2">Register</div>

            <a id="registerInstead" style="text-decoration:underline;" class="centerRelative text-center mt_1" href="{{route('login')}}">Login instead ?</a>

        </div>

    </div>

</div>


<script>

if(!is_pc){
        setTimeout(() => {
            if(mainContainer.offsetTop + mainContainer.offsetHeight < window.innerHeight - footer.offsetHeight){
                footer.style.position = "relative";
                footer.style.marginTop = "35vh";
            }
        }, 200);
    }

register_btn.onclick = function(){

    createAJAX("{{route('ajax.register')}}");
}


function createAJAX(my_url){

    let name = name_input.value || "";
    let email = email_input.value || "";
    let phone = phone_input.value || "";
    let password = password_input.value || "";
    let city = city_input.value || "";
    let address = address_input.value || "";

    $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: my_url,
        type: "POST",
        data:{
            "csrf-token": "{{ csrf_token() }}",
            name: name,
            email: email,
            phone: phone,
            password: password,
            city: city,
            address: address,
        },success: function (response) {
            
            if(response == 'already_exists'){
                showTopAlert("Account Already Exists", "An account with this email address is already registered");
            }
            else if(response.includes("login_success")){
                
                window.location = "{{route('account')}}";
            }
            else{
                showTopAlert("Invalid Data", "Please fill all required fields");
            }
            
        },
        error: function(jqXHR, textStatus, errorThrown) {
            return false;
        }
    });

}

</script>


@endsection