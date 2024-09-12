<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/kenwheeler/slick@1.8.1/slick/slick-theme.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<div class="items mt_1">

    @foreach($topSelling_products as $product)

        <div class="card">
            <div class="card-body">
                <a class="card_a" href="{{route('product.show', $product->id)}}">
                    <div class="cards_images_holders centerText_vertically">
                        <img class="cards_images " src="{{asset('all_images/products')}}/{{$product->mainImage}}" />
                    </div>
                  
                  
                  <div class="template-demo">
                      <p class="text-center titles">{{$product->title}}</p>
                      <h3 class="text-center mt_1">{{$product->price}} EGP</h3>
                  </div>
                </a>
                

                <hr>

                <div class="row">

                  <div class=" ">
                    <div class=" btns btns_t centerRelative" onclick="show_smallAlert_right_addToCart({{$product->id}})">Add To Cart</div>
                    </div>
                     
                </div>
            </div>
        </div>

    @endforeach
    

</div>


<script>

$(document).ready(function(){
    
    $('.items').slick({
  dots: true,
  infinite: true,
  speed: 800,
 autoplay: true,
 autoplaySpeed: 4000,
  slidesToShow: 4,
  slidesToScroll: 4,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    }

  ]
});
          });


</script>