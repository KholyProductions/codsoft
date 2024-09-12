@extends('admin.admin_main')

@section('content')

    <div class="mt_3 margins">

        <div id="products_holder">

            @foreach($all_products as $product)
                <div class="productsHolders" >
                    <a href="{{route('admin.open.product', $product->id)}}">
                        <div class="productsImagesHolders centerText_vertically">
                            <img class="productsImages " src="{{asset('all_images')}}/products/{{$product->mainImage}}" />
                        </div>
                        <div class="productsContent ">
                            <p style="color:#b90a18" class="product_titles text-center ">{{$product->title}}</p>
                            <h3 class="mt_1 text-center prices" style="font-weight:800; color:black;">{{$product->price}} EGP</h3>
                        </div>
                    </a>
                    
                    <a class="mt_1 btns btns_blue  centerRelative" href="{{route('admin.open.product', $product->id)}}">Modify Item</a>
                    <div class="btns btns_t mt_1 centerRelative"  onclick="show_alert_delete_item({{$product->id}})">Delete Item</div>
                    
                </div>
            @endforeach

            <div class="clearFloat"></div>

        </div>

    </div>


    <div id="admin_blackDiv" onclick="close_alert()"></div>
    <div id="admin_alert" class="horizontal_vertical_center_fixed">
        <h3 class="text-center">Are you sure you want to delete this item ?</h3>
        <div class="d-flex centerRelative mt_2" style="width:fit-content;">
            <div class="btns btns_t" onclick="yes_delete()">Yes</div>
            <div class="btns btns_t ml_3" onclick="close_alert()">No</div>
        </div>
    </div>


    <div class="extras"></div>

    <script>


        var productsHolders = document.querySelectorAll(".productsHolders");
        var productsHolders_position = 0;

        showProductsHolders();

        function showProductsHolders(){

                productsHolders[productsHolders_position].style.opacity = 1;
                productsHolders[productsHolders_position].style.top = 0;

                productsHolders_position++

                if(productsHolders_position < productsHolders.length){
                    setTimeout(() => {
                        showProductsHolders();
                    }, 200);
                }
            
        }

        var product_chosen_id;

        function show_alert_delete_item(product_id){

            product_chosen_id = product_id;

            admin_blackDiv.style.display = "initial";
            admin_alert.style.display = "initial";
            setTimeout(() => {
                admin_alert.style.opacity = 1;
                admin_blackDiv.style.opacity = 0.7;
            }, 100);

        }

        function close_alert(){
            admin_alert.style.opacity = 0;
            admin_blackDiv.style.opacity = 0;
            setTimeout(() => {
                admin_blackDiv.style.display = "none";
                admin_alert.style.display = "none";  
            }, 1000);
        }

        function yes_delete(){
            let id = product_chosen_id;

            $.ajax({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('ajax.delete.product')}}",
            type: "POST",
            data:{
                "csrf-token": "{{ csrf_token() }}",
                id: id,
            },success: function (response) {
                window.location = "{{route('admin.get')}}";
            },
            error: function(jqXHR, textStatus, errorThrown) {
                return false;
            }
        });
        }


    </script>

@endsection