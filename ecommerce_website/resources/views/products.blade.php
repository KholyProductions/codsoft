@extends('main')

@section('metas')
    <title>Our Products - Hardica</title>
    <meta name="description" content="At our store, you'll find a wide range of equipment to choose from, including Gym Supplies, Cardio, Sporting Goods, Accessories, and much more. Our products are of the highest quality, designed to help you perform your best and achieve your goals.">
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('css/v_1/home_pc.css?v=1')}}">
@endsection

@section('content')

    <h1 class="text-center mt_4">Hardica Products</h1>
    <p class="text-center mt_1 margins ">Our products are of the highest quality, designed to help you perform your best and achieve your goals.</p>

    @if(strlen($genre) > 0)
        
        <div class="margins mt_3">
            <h3>Products/{{$genre}}</h3>
        </div>
    @endif
    @if(strlen($search) > 0)
        <div class="margins mt_3">
            <h3 class="text-center">Searching for: {{$search}}</h3>
        </div>
    @endif

    <div class="margins mt_3">

        @if(sizeof($wantedProducts) == 0)

            <h2 class="text-center">No results found</h2>
            <p class="text-center mt_1">Explore our top selling products</p>

            <div class="mt_3">
                @include('components.carousel_topselling')
            </div>

        @else

            <div id="products_holder">

                @foreach($wantedProducts as $product)
                    <div class="productsHolders" >
                        <a href="{{route('product.show', $product->id)}}">
                            <div class="productsImagesHolders centerText_vertically">
                                <img class="productsImages " src="{{asset('all_images')}}/products/{{$product->mainImage}}" />
                            </div>
                            <div class="productsContent ">
                                <p style="color:#b90a18" class="product_titles text-center ">{{$product->title}}</p>
                                <h3 class="mt_1 text-center prices" style="font-weight:800; color:black;">{{$product->price}} EGP</h3>
                            </div>
                        </a>

                        <a class="mt_1 centerRelative btns btns_t" onclick="show_smallAlert_right_addToCart({{$product->id}})">Add To Cart</a>
                        
                    </div>
                @endforeach

                <div class="clearFloat"></div>

            </div>

        @endif

    </div>


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

        
    </script>

@endsection