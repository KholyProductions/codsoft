<div class="w-50 centerRelative w_100 paymentContainers" >

    <h2 class="text-center">Order Total</h2>
    <h3 class="text-center mt_2">{{$total}} EGP</h3>
    <p class="text-center mt_2">Enter the phone number that <span style="color:#b90a18;">you will use to transfer the amount</span></p>
    <input type="text" placeholder="Enter your phone number" class="inputs w-50 mt_2 centerRelative" id="phone_input"/>
    <p class="text-center mt_2">Transfer the amount to the phone number below then click on the button</p>
    <div class=" text-center mt_2" id="phoneNumber">01221622223</div>
    <div class="mt_2 centerRelative btns btns_red" onclick="paid_fc()">I have paid</div>

</div>



<script>

    function paid_fc(){
        if(phone_input.value.length < 10){
            showTopAlert("Invalid Information", "Please enter your phone number ,and transfer the amount before clicking the button");
            return;
        }

        let phone_payment = phone_input.value;

        $.ajax({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('ajax.update.phone_payment')}}",
                type: "POST",
                data:{
                    "csrf-token": "{{ csrf_token() }}",
                    phone_payment: phone_payment,
                },success: function (response) {
                    //submitOrder_btn.disabled = true;
                    //cart_count_div.innerHTML = 0; 
                    //showTopAlert("Order Placed Successfully", "Thank you for your order");
                    window.location = "{{route('thankyou')}}?track={{$tracking_id}}";
                    
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    return false;
                }
            });
    }


</script>