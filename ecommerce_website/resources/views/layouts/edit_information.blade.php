
<div>
    <h2 >Manage Personal Information</h2>


    <h4 class="mt_2">Name:</h4>
    <input type="name" id="name_input" value="{{$name}}" class="inputs w-100" placeholder="Enter your name"/>
    <p class="errors " id="name_error_text">Name cannot be empty</p>

    <h4 class="mt_2">Email: {{$email}}</h4>

    <h4 class="mt_2">Phone Number</h4>
    <input type="phone" id="phone_input" value="{{$phone}}" class="inputs w-100" placeholder="Enter your phone number"/>

    <h4 class="mt_2">City:</h4>
    <input type="text" id="city_input" value="{{$city}}" class="inputs w-100" placeholder="Enter your city"/>
    
    <h4 class="mt_2">Address:</h4>
    <input type="text" id="address_input" value="{{$address}}" class="inputs w-100" placeholder="Enter your address"/>

    <h4 class="mt_2">Password:</h4>
    <input type="password" id="password_input" value="{{$password}}"  class="inputs w-100" placeholder="Enter your password"/>
    
    <div class="mt_2 centerRelative text-center">
        <p class="errors " id="error_text">Please fill all required fields</p>
        <div  class="centerRelative btns  btns_t mt_1" id="submit">Submit</div>
    </div>
        
</div>


<script>

    submit.onclick = function(){

        let name = name_input.value || '';
        let phone = phone_input.value || '';
        let city = city_input.value || '';
        let address = address_input.value || '';
        let password = password_input.value || '';

        if(name.length > 0 && phone.length > 0 && city.length > 0 && address.length > 0 && password.length > 0){

            $.ajax({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('ajax.update.personal_information')}}",
                type: "POST",
                data:{
                    "csrf-token": "{{ csrf_token() }}",
                    name: name,
                    phone: phone,
                    password: password,
                    city: city,
                    address: address,
                },success: function (response) {   
                    
                    showTopAlert("Success", "Your personal info has been updated");
                    
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    return false;
                }
            });
        }
        else{
            error_text.style.display = "initial";
        }

    }


</script>