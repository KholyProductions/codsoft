@extends('admin.admin_main')

@section('content')

    <h1 class="mt_3 text-center">Order ID: {{$wanted_order->id}}</h1>
    <h3 class="mt_1 text-center">Name: {{$wanted_order->name}}</h3>
    <h3 class="mt_1 text-center">Order Total: {{$wanted_order->total}} EGP</h3>
    <h3 class="mt_1 text-center" id="status_html">Status: {{$wanted_order->status}}</h3>
    <div class="centerRelative mt_2 d-flex" style="width:fit-content;">
        <div style="width:fit-content;">
            <input type="radio" id="processing_cb" name="statuses" class="centerRelative"/>
            <h4 >Processing</h4>
        </div>
        <div style="width:fit-content;" class="ml_2">
            <input type="radio" id="paid_cb" name="statuses" class="centerRelative"/>
            <h4 >Paid</h4>
        </div>
        <div style="width:fit-content;" class="ml_2">
            <input type="radio" id="shipped_cb" name="statuses" class="centerRelative"/>
            <h4 >Shipped</h4>
        </div>
        <div style="width:fit-content;" class="ml_2">
            <input type="radio" id="delivered_cb" name="statuses" class="centerRelative"/>
            <h4 >Delivered</h4>
        </div>
    </div>
    <div class="btns centerRelative btns_t mt_2" id="update_status_btn">Update Status</div>
    <div class="margins mt_4">
        <div class="w-75 centerRelative">
            <h4 class=" ">Created At: {{$wanted_order->date_created}}</h4>
            <h4 class=" ">Email: {{$wanted_order->email}}</h4>
            <h4 class=" ">Phone: {{$wanted_order->phone}}</h4>
            <h4 class=" ">City: {{$wanted_order->city}}</h4>
            <h4 class=" ">Address: {{$wanted_order->address}}</h4>
            <h4 class=" ">Phone Payment: {{$wanted_order->phone_payment}}</h4>
            @if(strlen($wanted_order->notes) > 0)
                <h4 class=" ">Notes: {{$wanted_order->notes}}</h4>
            @endif
        </div>

        <div id="ordersHolder" class="mt_3 w-75 centerRelative">
            <div id="ordersHolder_inside">
                @foreach($items_class_arr as $key => $item)
                    @if($item->quantity > 0)
                        <div class="items">
                            <div class="items_images_holders">
                                <img class="items_images" src="{{asset('all_images/products')}}/{{$item->mainImage}}" />
                            </div>
                            <h4 class="text-center mt_1">Unit Price: {{$item->price}} EGP</h4>
                            <h4 class="text-center mt_1">Quantity: {{$item->quantity}}</h4>
                            <h4 class="text-center mt_1">Total Price: {{$item->amount}} EGP</h4>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    
    
    <div class="extras"></div>




    <script>

        update_status_btn.onclick = function(){
            let status = "";
            let id = "{{$id}}";

            if(processing_cb.checked){
                status = "Processing";
            }
            if(paid_cb.checked){
                status = "Paid";
            }
            if(shipped_cb.checked){
                status = "Shipped";
            }
            if(delivered_cb.checked){
                status = "Delivered";
            }


            $.ajax({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{route('ajax.update.order.status')}}",
                type: "POST",
                data:{
                    "csrf-token": "{{ csrf_token() }}",
                    status: status,
                    id: id,
                },success: function (response) {
                    status_html.innerHTML = "Status: " + status;
                    
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    return false;
                }
            });

        }


    </script>



@endsection