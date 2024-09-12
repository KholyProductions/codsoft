@extends('main')

@section('metas')
    <meta name="robots" content="noindex,nofollow">
    <title>Thank you - Get Fit Egypt</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('css/v_1/home_pc.css?v=1')}}">
@endsection

@section('content')

    @if($wantedOrder == null)

        <div class="mt_4 margins">
            <h1 class=" text-center">Track your shipment</h1>
            <p class="mt_1 text-center">You can find your tracking code in your confirmation email sent to you after submitting your order</p>
            <div class="mt_2 w-75 w_100 centerRelative">
                <input type="text" placeholder="Enter your tracking code" id="tracking_input" class="centerRelative inputs w-50 " />
            </div>
            <div class="mt_2 centerRelative btns btns_t" onclick="track_fc()">Track Shipment</div>
        </div>

    @else

        <h1 class="mt_4 text-center">Thank you for your order</h1>
        <h3 class="mt_1 text-center">Tracking Code: {{$wantedOrder->tracking_id}}</h3>
        <h3 class="mt_1 text-center">Order Status: {{$wantedOrder->status}}</h3>

        <div class="mt_3 margins ">

        </div>
    @endif


    <div class="mt_4 margins">
        <video width="100%" height="auto" controls autoplay loop muted>
          <source src="{{asset('videos/homepage-getfit-video.mp4')}}" type="video/mp4">
        </video>
    </div>


    <script>

        function track_fc(){
            let tracking_id = tracking_input.value || '';
            $.ajax({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('ajax.track.shipment')}}",
                type: "POST",
                data:{
                    "csrf-token": "{{ csrf_token() }}",
                    tracking_id: tracking_id,
                },success: function (response) {
                    //submitOrder_btn.disabled = true;
                    //cart_count_div.innerHTML = 0; 
                    if(response.includes("null")){
                        showTopAlert("Invalid Tracking Code", "Please enter a valid tracking code");
                    }
                    else{
                        window.location = "{{route('thankyou')}}?track=" + response;
                    }
                    
                    
                    
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    return false;
                }
            });
        }






    </script>

@endsection