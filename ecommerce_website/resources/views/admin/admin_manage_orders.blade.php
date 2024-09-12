@extends('admin.admin_main')

@section('content')

    <h1 class="mt_3 text-center">Manage Orders</h1>

    <div class="margins mt_3">

        @if(sizeof($new_orders) > 0)
        
            <div class=" centerRelative orders_sections_holders">
                <h2>New Orders</h2>
                
                <div class=" mt_2">
                    <table>
                        <tr>
                            <th>View Order</th>
                            <th>Order ID</th>
                            <th>Date Created</th>
                            <th>Name</th>
                            <th>City</th>
                            <th>Address</th>
                            <th>Total Price</th>
                        </tr>
                        @foreach($new_orders as $order)
                            <tr>
                                <td><a class="btns btns_t" href="{{route('admin.open.order', $order->id)}}">Open Order</a></td>
                                <td>{{$order->id}}</td>
                                <td>{{$order->date_created}}</td>
                                <td>{{$order->name}}</td>
                                <td>{{$order->city}}</td>
                                <td>{{$order->address}}</td>
                                <td>{{$order->total}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>

            </div>

        @else
            <h2>New Orders</h2>
            <h3 class="mt_1">No orders to show</h3>
        @endif

        
        <hr class="mt_3" />


        @if(sizeof($paid_orders) > 0)
        
            <div class=" mt_3 centerRelative orders_sections_holders">
                <h2>Paid Orders</h2>
                
                <div class=" mt_2">
                    <table>
                        <tr>
                            <th>View Order</th>
                            <th>Order ID</th>
                            <th>Date Created</th>
                            <th>Name</th>
                            <th>City</th>
                            <th>Address</th>
                            <th>Total Price</th>
                        </tr>
                        @foreach($paid_orders as $order)
                            <tr>
                                <td><a class="btns btns_t" href="{{route('admin.open.order', $order->id)}}">Open Order</a></td>
                                <td>{{$order->id}}</td>
                                <td>{{$order->date_created}}</td>
                                <td>{{$order->name}}</td>
                                <td>{{$order->city}}</td>
                                <td>{{$order->address}}</td>
                                <td>{{$order->total}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>

            </div>

        @else
            <h2 class="mt_3">Paid Orders</h2>
            <h3 class="mt_1">No orders to show</h3>
        @endif


        <hr class="mt_3" />


        @if(sizeof($shipped_orders) > 0)
        
            <div class=" mt_3 centerRelative orders_sections_holders">
                <h2>Shipped Orders</h2>
                
                <div class=" mt_2">
                    <table>
                        <tr>
                            <th>View Order</th>
                            <th>Order ID</th>
                            <th>Date Created</th>
                            <th>Name</th>
                            <th>City</th>
                            <th>Address</th>
                            <th>Total Price</th>
                        </tr>
                        @foreach($shipped_orders as $order)
                            <tr>
                                <td><a class="btns btns_t" href="{{route('admin.open.order', $order->id)}}">Open Order</a></td>
                                <td>{{$order->id}}</td>
                                <td>{{$order->date_created}}</td>
                                <td>{{$order->name}}</td>
                                <td>{{$order->city}}</td>
                                <td>{{$order->address}}</td>
                                <td>{{$order->total}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>

            </div>

        @else
            <h2 class="mt_3">Shipped Orders</h2>
            <h3 class="mt_1">No orders to show</h3>
        @endif


        <hr class="mt_3" />


        @if(sizeof($delivered_orders) > 0)
        
            <div class="mt_3 centerRelative orders_sections_holders">
                <h2>Delivered Orders</h2>
                
                <div class=" mt_2">
                    <table>
                        <tr>
                            <th>View Order</th>
                            <th>Order ID</th>
                            <th>Date Created</th>
                            <th>Name</th>
                            <th>City</th>
                            <th>Address</th>
                            <th>Total Price</th>
                        </tr>
                        @foreach($delivered_orders as $order)
                            <tr>
                                <td><a class="btns btns_t" href="{{route('admin.open.order', $order->id)}}">Open Order</a></td>
                                <td>{{$order->id}}</td>
                                <td>{{$order->date_created}}</td>
                                <td>{{$order->name}}</td>
                                <td>{{$order->city}}</td>
                                <td>{{$order->address}}</td>
                                <td>{{$order->total}}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>

            </div>

        @else
            <h2 class="mt_3">Delivered Orders</h2>
            <h3 class="mt_1">No orders to show</h3>
        @endif

        
    </div>


    <div class="extras"></div>

@endsection