@extends('main')

@section('metas')
    <title>{{$wantedProduct->title}} - Hardica</title>
    <meta name="description" content="{{$wantedProduct->description}}">
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('css/v_1/home_pc.css?v=1')}}">
    <link rel="stylesheet" href="{{asset('css/v_1/home_mobile.css?v=9')}}">
@endsection

@section('content')


    <div class="mt_3 margins " id="productShowMainContainer">
        
        <div id="productShow_leftDiv">
            <h1 class="text-center">{{$wantedProduct->title}}</h1>
            <img class="mt_2 centerRelative" id="mainImage" src="{{asset('all_images/products')}}/{{$wantedProduct->mainImage}}" />
            <div class="mt_2 " id="smallImagesMainContainer" style="overflow-x:auto; position:relative;">
                <div class="d-flex centerRelative" id="mainProductImagesHolder">
                    @foreach($wantedProduct->images as $image)
                        <img class="mainProductImages" onclick="changeImage('{{$image}}')" src="{{asset('all_images/products')}}/{{$image}}" />
                    @endforeach
                </div>
            </div>
        </div>

        <div id="productShow_rightDiv">

            <div>
                <h2 class="text_3xl text-center">{{$wantedProduct->price}} EGP</h2>
                <div class="mt_2 d-flex centerRelative centerText_vertically" style="width:fit-content;">
                    <a class=" btns btns_t" onclick="show_smallAlert_right_addToCart({{$wantedProduct->id}})">Add To Cart</a>
                    <a class="ml_2 btns_underline_b" >Speak To Agent</a>
                </div>
                

                <h3 class="text-center mt_3" style="font-weight:700;">Product Information</h3>
                <p class="mt_2 ">{!! $wantedProduct->description !!}</p>

                @if(strlen($wantedProduct->description) < 600)
                    <div class="mt_3 delete_mobile">
                        <h3 style="font-weight:700;" class="text-center">New Arrivals</h3>
                        <div class="mt_1">
                            @include('components.carousel_2_new')
                        </div>
                    </div>
                @endif
            </div>

        </div>
        

    </div>


    @if(strlen($wantedProduct->video) > 0)
        <div style="width:100vw;" >
            {!! $wantedProduct->video !!}
        </div>

    @endif

    <div class="margins" id="relatedProducts_container">
        <h3 style="font-weight:700;" class="text-center">Related Products</h3>
        <div class="mt_2">
            @include('components.carousel_related')
        </div>
    </div>

    <div class="margins mt_4" >
        <h3 style="font-weight:700;" class="text-center">Top Selling Products</h3>
        <div class="mt_2">
            @include('components.carousel_topselling')
        </div>
    </div>


    <script>

        function changeImage(image){

            mainImage.src = "{{asset('all_images/products')}}/" + image;

        }



    </script>





@endsection