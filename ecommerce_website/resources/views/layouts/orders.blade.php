<h2>My Orders</h2>

<div class="mt_2">


    @foreach($wantedOrders as $key => $order)


        <div class="d-flex justify-content-between mt_2 statusHolders">
            <h4>Order Status: {{$wantedOrders_arr[$key]->status}}</h4>
            <h4>Order Total: {{$wantedOrders_arr[$key]->total}} EGP</h4>
        </div>    
        <div id="ordersHolder" class="mt_2">
            <div id="ordersHolder_inside">

                @foreach($order as $pos => $item)

                    @if($item->quantity > 0)
                        <div class="items_orders">
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

        <hr class="mt_2" />

    @endforeach
        
    
    @if(sizeof($wantedOrders) == 0)

        <h2 class="text-center mt_2">No Orders to show</h2>
        <h4 class="mt_2 text-center">You haven't submitted any orders yet</h4>
    @endif

</div>



<script>

    


</script>