<div id="admin_header" class="d-flex justify-content-between margins">

    <div>
        <img id="admin_logo_header" src="{{asset('all_images/logo.png')}}" />
    </div>

    <div class="centerText_vertically">
        <a class="admin_menuItems" href="{{route('admin.manage.products')}}">Manage Products</a>
        <a class="admin_menuItems ml_3" href="{{route('admin.add.product')}}">Add Product</a>
        <a class="admin_menuItems ml_3" href="{{route('admin.orders.get')}}">Manage Orders</a>
    </div>

</div>