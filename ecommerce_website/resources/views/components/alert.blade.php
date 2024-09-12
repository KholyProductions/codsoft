<div id="smallAlert_right">

    <div class="centerText_vertically d-flex">
        <img class="" id="smallAlert_right_image" src="{{asset('all_images/cart-icon.png')}}" />
        <p class="ml_1 " id="smallAlert_right_text"></p>
    </div>

</div>

<div id="topAlert">
    <h2 id="topAlert_title" class="text-center"></h2>
    <p class="text-center mt_1" id="topAlert_msg"></p>
    <div class="btns btns_t centerRelative mt_1" onclick="closeTopAlert()">Close</div>
</div>

<div id="blackDiv"></div>

<script>



    function showTopAlert(title, msg){
        topAlert_title.innerHTML = title;
        topAlert_msg.innerHTML = msg;
        blackDiv.style.display = "initial";
        setTimeout(() => {
            topAlert.style.top = 0;
            blackDiv.style.opacity = 0.7;
        }, 300);
    }

    function closeTopAlert(){
        topAlert.style.top = "-55vw";
        blackDiv.style.opacity = 0;
        setTimeout(() => {
            blackDiv.style.display = "none";
        }, 700);
    }

    


    function show_smallAlert_right_addToCart(product_id){

        smallAlert_right_image.src = "{{asset('all_images/cart-icon.png')}}";
        smallAlert_right_text.innerHTML = "Added to cart";

        smallAlert_right.style.right = 0 + "px";
        setTimeout(() => {
            smallAlert_right.style.right = "-55vw";
        }, 3500);

        $.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "{{route('ajax.add.cart')}}",
        type: "POST",
        data:{
            "csrf-token": "{{ csrf_token() }}",
            id: product_id,
        },success: function (response) {
            cart_count_div.innerHTML = response;          
        },
        error: function(jqXHR, textStatus, errorThrown) {
            return false;
        }
    });
    }


</script>