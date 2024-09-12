@extends('main')

@section('metas')
    <meta name="robots" content="noindex,nofollow">
    <title>Checkout - Get Fit Egypt</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('css/v_1/home_pc.css?v=1')}}">
    <link rel="stylesheet" href="{{asset('css/v_1/home_mobile.css?v=2')}}">
@endsection

@section('content')

    <div class="margins mt_3">
        <h1 class="text-center">Checkout</h1>
        @if(sizeof($cart_arr) > 0)
        <div id="checkoutMainContainer">
            <div class="mt_3 " id="checkout_leftDiv">
                <h2>Customer</h2>

                <div class="mt_2">
                    
                    <div class="d-flex justify-content-between">

                        <div class="checkoutInputsHolders">
                            <h4>Name:</h4>
                            <input type="name" value="{{$name}}" id="name_input" class="inputs w-100" placeholder="Enter your name"/>

                            <h4 class="mt_2">Phone Number</h4>
                            <input type="phone" value="{{$phone}}" id="phone_input" class="inputs w-100" placeholder="Enter your phone number"/>
                        </div>

                        <div class="checkoutInputsHolders">
                            <h4 class="">Email:</h4>
                            <input type="email" value="{{$email}}" id="email_input" class="inputs w-100" placeholder="Enter your email"/>

                            <h4 class="mt_2">City:</h4>
                            <input type="text" value="{{$city}}" id="city_input" class="inputs w-100" placeholder="Enter your city"/>
                        </div>

                    </div>
                    
                    <h4 class="mt_2">Address:</h4>
                    <input type="text" value="{{$address}}" id="address_input" class="inputs w-100" placeholder="Enter your address"/>
                        

                </div>

                <h2 class="mt_3">Order Details</h2>

                @foreach($cart_arr as $key => $product)

                    <div class="cartProductsHolders ">
                        <div class="cartImagesHolders centerText_vertically"><img class="cartImages" src="{{asset('all_images/products')}}/{{$product->mainImage}}" /></div>
                        <p class="cartTitles centerText_vertically">{{$product->title}}</p>
                        <div class="centerText_vertically">
                            <div>
                                <h4 class="text-center">Price</h4>
                                <p class="text-center cart_prices">{{$product->price}}</p>
                                <p class="text-center"> EGP</p>
                            </div>
                        </div>
                        <div class="centerText_vertically">
                            <div>
                                <h4 class="text-center">Quantity</h4>
                                <input type="number" class="quantity_input  centerRelative" value="1" />
                                <div class="text-center updateQuantities" onclick="updateQuantity_fc('{{$key}}')">Update Quantity</div>
                            </div>
                        </div>

                        <div class="centerText_vertically">
                            <div>
                                <h4 class="text-center">Amount</h4>
                                <p class="text-center cartAmountsPrices">{{$product->price}}</p>
                                <p class="text-center"> EGP</p>
                            </div>
                        </div>

                        <div class="centerText_vertically" onclick="deleteItem('{{$key}}', '{{$product->id}}')">
                            <img class="cart_x_btns" src="{{asset('all_images/x_btn.png')}}" />
                        </div>
                    </div>

                    

                    <hr class="mt_1 hr" />
                    

                @endforeach

                <h2 class="mt_3">Shipping Method</h2>

                <div class="mt_2 d-flex">
                    <img id="shipping_icon" class="centerText_vertically" src="{{asset('all_images/shipping-icon-2.png')}}" />
                    <div class="ml_1 centerText_vertically">
                        <div>
                            <h4 >Shipping Cost 90 EGP</h4>
                            <p>Delivery within 6 working days</p>
                        </div>
                    </div>
                    
                </div>

                <h2 class="mt_3">Payment Methods</h2>

                <div class="mt_2 d-flex">
                    <input type="radio" checked id="mobilePayments_cb" class="centerText_vertically" name="paymentMethod_inputs"/>
                    <img id="cod_icon" class="centerText_vertically ml_1" src="{{asset('all_images/mobile-payments-icon.png')}}" />
                    <div class="ml_1 centerText_vertically">
                        <div>
                            <h4 >Mobile Wallet</h4>
                            <p>Pay Through Vodafone Cash, Orange Cash, Etisalat Cash</p>
                        </div>
                    </div>
                </div>
                <!--
                <div class="mt_1 d-flex">
                    <input type="radio" id="visa_cb" class="centerText_vertically" name="paymentMethod_inputs"/>
                    <img id="cod_icon" class="centerText_vertically ml_1" src="{{asset('all_images/visa.png')}}" />
                    <div class="ml_1 centerText_vertically">
                        <div>
                            <h4 >PayPal, VISA</h4>
                            <p>Pay Through PayPal, VISA</p>
                        </div>
                    </div>
                </div>
                -->

                <h2 class="mt_3">Customer's Notes</h2>
                <textarea id="customerNotes_input" placeholder="If you have additional notes or any special requests, please type them here" class="inputs w-100 mt_1"></textarea>

            </div>

            <div id="checkout_rightDiv" class="mt_3">
                <div id="orderSummaryDiv">
                    <h3 class="text-center">Order Summary</h3>
                    <div class="mt_2 d-flex justify-content-between">
                        <p>Product Quantity:</p>
                        <p id="summary_quantity">{{sizeof($cart_arr)}} item(s)</p>
                    </div>
                    <div class="mt_1 d-flex justify-content-between">
                        <p>Amount:</p>
                        <p id="orderTotal">6000 EGP</p>
                    </div>
                    <div class="mt_1 d-flex justify-content-between">
                        <p>Shipping:</p>
                        <p>90 EGP</p>
                    </div>
                    <div class="mt_1 d-flex justify-content-between">
                        <p class="centerText_vertically">Order Total:</p>
                        <h3 style="font-weight:800;" id="orderFinalTotal">6090 EGP</h3>
                    </div>
                    <div onclick="submitOrder()" id="submitOrder_btn" class="btns  btns_t centerRelative mt_2">Checkout</div>
                </div>
            </div>

        </div>
        
        @else

            <h2 class="mt_3 text-center">Your shopping cart is empty</h2>
            <p class="mt_2 w-75 centerRelative text-center">Your One-Stop Shop for High-Quality Sports Equipment in Egypt. Our products are of the highest quality, designed to help you perform your best and achieve your goals.</p>
            <a class="mt_2 centerRelative btns btns_t" href="{{route('products.all')}}">Explore products</a>

        @endif
        
    </div>




    <script>


        /*
        setTimeout(() => {
            if(!is_pc && (footer.offsetTop + footer.offsetHeight  < window.innerHeight)){
                footer.style.position = "absolute";
                footer.style.bottom = 0;
                footer.style.left = 0;
            }
        }, 100);
        */
        

        var cartProductsHolders = document.querySelectorAll(".cartProductsHolders");
        var cart_prices = document.querySelectorAll(".cart_prices");
        var quantity_input = document.querySelectorAll(".quantity_input");
        var updateQuantities = document.querySelectorAll(".updateQuantities");
        var cartAmountsPrices = document.querySelectorAll(".cartAmountsPrices");
        var cart_x_btns = document.querySelectorAll(".cart_x_btns");
        var hr = document.querySelectorAll(".hr");

        var cart_id_arr = <?php echo json_encode($cart_id_arr); ?>;

        updateSummary();

        function updateQuantity_fc(key){
            
            let totalAmount = quantity_input[key].value * cart_prices[key].innerHTML;
            cartAmountsPrices[key].innerHTML = totalAmount;
            
            updateSummary();
        }
        

        function deleteItem(key, id){
            cartAmountsPrices[key].innerHTML = 0;
            quantity_input[key].value = 0;
            cartProductsHolders[key].style.display = "none";
            hr[key].style.display = "none";
            updateSummary();

            $.ajax({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('ajax.remove.cart.item')}}",
                type: "POST",
                data:{
                    "csrf-token": "{{ csrf_token() }}",
                    id: id,
                },success: function (response) {
                    console.log("success");            
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    return false;
                }
            });
        }


        function updateSummary(){

            summary_quantity.innerHTML = getQuantity() + " item(s)";
            orderTotal.innerHTML = getAmounts() + " EGP";
            orderFinalTotal.innerHTML = Number(getAmounts() + 90) + " EGP";

            cart_count_div.innerHTML = getQuantity();
        }

        function getQuantity(){
            let quantity = 0;
            for (let i = 0; i < quantity_input.length; i++) {
                quantity += Number(quantity_input[i].value);
            }
            return quantity;
        }


        function getAmounts(){
            let totalAmount = 0;
            for (let i = 0; i < cartAmountsPrices.length; i++) {
                totalAmount += Number(cartAmountsPrices[i].innerHTML);
            }
            return totalAmount;
        }

        function getPaymentMethod(){

            if(mobilePayments_cb.checked){
                return "mobile";
            }
            if(visa_cb.checked){
                return "visa";
            }

            return null;
        }


        function submitOrder(){

            let name = name_input.value;
            let email = email_input.value;
            let phone = phone_input.value;
            let city = city_input.value;
            let address = address_input.value;
            let order_details = getOrderDetails();
            let shipping = 90;
            let notes = customerNotes_input.value || "";
            let status = "Processing";
            let total = Number(getAmounts() + shipping);

            if(name.length == 0
            || email.length == 0
            || phone.length == 0
            || city.length == 0
            || address.length == 0
            || total <= shipping){
                showTopAlert("Missing Information", "Please fill all required fields");
                return;
            }

            if(getPaymentMethod() == null){
                showTopAlert("Missing Information", "Please choose payment method");
                return;
            }


            $.ajax({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('ajax.submit.order')}}",
                type: "POST",
                data:{
                    "csrf-token": "{{ csrf_token() }}",
                    name:name,
                    email:email,
                    phone:phone,
                    city:city,
                    address:address,
                    order_details:order_details,
                    shipping:shipping,
                    notes:notes,
                    status:status,
                    total:total,
                },success: function (response) {
                    //submitOrder_btn.disabled = true;
                    //cart_count_div.innerHTML = 0; 
                    //showTopAlert("Order Placed Successfully", "Thank you for your order");
                    if(getPaymentMethod() == "visa"){
                        window.location = "{{route('payment')}}?type=visa";
                    }
                    else{
                        window.location = "{{route('payment')}}?type=mobile";
                    }
                    
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    return false;
                }
            });
        }


        function getOrderDetails(){

            let orderDetails = "";

            for (let i = 0; i < cartProductsHolders.length; i++) {
                if(i > 0){
                    orderDetails += ",,,";
                }
                if(cartAmountsPrices.innerHTML !== 0){
                    orderDetails += "ID_" + cart_id_arr[i] + ",";
                    orderDetails += "Price_" + cart_prices[i].innerHTML + ",";
                    orderDetails += "Quantity_" + quantity_input[i].value + ",";
                    orderDetails += "Amount_" + cartAmountsPrices[i].innerHTML;
                }
            }

            return orderDetails;

        }

    </script>


@endsection
