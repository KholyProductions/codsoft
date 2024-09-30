@extends('main')



@section('content')

<div id="login_mainContainer">

    <div id="loginContainer" class=" centerRelative">

        <h1 class="text-center">Login</h1>

        <div id="form" class="centerRelative w-100 w_100 mt_2">
            
            <h4>Email:</h4>
            <input type="email" id="email_input" class="inputs w-100" placeholder="Enter your email"/>
            
            <h4 class="mt_2">Password:</h4>
            <input type="password" id="password_input" class="inputs w-100" placeholder="Enter your password"/>

            <div id="login_btn" class="centerRelative btns btns_t mt_2">Login</div>

            <a id="registerInstead" style="text-decoration:underline;" class="centerRelative text-center mt_1" href="{{route('register')}}">Register instead ?</a>

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

login_btn.onclick = function(){

    createAJAX("{{route('ajax.login')}}");
}


function createAJAX(my_url){

    $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: my_url,
        type: "POST",
        data:{
            "csrf-token": "{{ csrf_token() }}",
            email: email_input.value,
            password: password_input.value,
        },success: function (response) {
            console.log("success");

            if(response == "login_success"){
                window.location = "{{route('account')}}";
            }
            
            else{
                showTopAlert("Invalid Data", "Wrong username or password");
            }
            
        },
        error: function(jqXHR, textStatus, errorThrown) {
            return false;
        }
    });

}

</script>


@endsection