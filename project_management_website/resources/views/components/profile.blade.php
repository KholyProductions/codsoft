<div class="">
    @if($wantedAdmin !== null && $canAccess)
        <h4 >Email: {{$wantedAdmin->email}}</h4>
        <h4 class="mt_1">Name:</h4>
        <input type="name" id="profile_name_input" class="inputs w-50 w_100" value="{{$wantedAdmin->name}}" placeholder="Enter your name"/>
        <h4 class="mt_1">Password:</h4>
        <input type="password" id="profile_password_input" class="inputs w-50 w_100" value="{{$wantedAdmin->password}}" placeholder="Enter your password"/>
        <div class="mt_2 d-flex centerText_vertically" style="width:fit-content;">
            <div class="btns btns_black" onclick="saveProfile()">Save Changes</div>
            <a class="ml_2" style="cursor:pointer; text-decoration:underline;" onclick="logout_fc()">Logout</a>
        </div>
    @else
        <h3>Guest</h3>
    @endif
</div>



<script>


    function saveProfile(){
        let email = "{{$wantedAdmin->email}}";        
        let name = profile_name_input.value;
        let password = profile_password_input.value;

        if(name.length > 0 && password.length >= 6){
            $.ajax({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('ajax.save.profile')}}",
                type: "POST",
                data:{
                    "csrf-token": "{{ csrf_token() }}",
                    name: name,
                    email: email,
                    password: password,

                },success: function (response) {
                    showSmallAlertRight("Changes Saved Successfully");
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    return false;
                }
            });
        }
        else{
            if(name.length == 0 && password.length < 6){
                showTopAlert("Invalid Data", "Name cannot be empty. Password must be 6 characters at least");
            }
            else if(name.length == 0){
                showTopAlert("Invalid Data", "Name cannot be empty.");
            }
            else{
                showTopAlert("Invalid Data", "Password must be 6 characters at least");
            }
        }

        
    }



    function logout_fc(){
        $.ajax({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('ajax.logout')}}",
                type: "POST",
                data:{
                    "csrf-token": "{{ csrf_token() }}",

                },success: function (response) {
                    window.location = "{{route('home')}}";
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    return false;
                }
            });
    }


</script>