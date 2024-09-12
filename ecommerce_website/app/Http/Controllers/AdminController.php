<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Products;
use App\Models\Orders;
use App\Models\Items;

use Session;

class AdminController extends Controller
{
    
    public function admin_get(){

        $admin_loggedIn = Session::get('admin_loggedIn') ?? 'false';
        $all_products = Products::get();

        for ($i=0; $i < sizeof($all_products); $i++) { 
            $images = $all_products[$i]->images;
            $images = explode(",,,", $images);
            $all_products[$i]->mainImage = $images[0];
        }

        if($admin_loggedIn == 'true'){
            return view('admin.manage_products',[
                'all_products' => $all_products,
            ]);
        }

        return view('admin.admin_login');
    }

    public function admin_post(Request $request){

        $all_products = Products::get();

        $username_input = $request->username_input;
        $password_input = $request->password_input;

        $username = "123321a";
        $password = "123321a";

        if($username_input == $username && $password_input == $password){
            Session::put('admin_loggedIn', 'true');
            return redirect()->route('admin.manage.products');
        }

        return view('admin.admin_login');
    }

    public function admin_add_product_get(){

        if(Session::get('admin_loggedIn') !== 'true'){
            return view('admin_login');
        }

        Session::put('images', '');
        return view('admin.add_product');

    }

    public function ajax_add_product_image(Request $request){
        
        $image = $request->file('file');
        $fileName = $image->getClientOriginalName();

        $image->move("all_images/products", $fileName);

        $images = Session::get('images') ?? '';
        if(strlen($images) > 0){
            $images .= ",,," . $fileName;
        }
        else{
            $images = $fileName;
        }

        Session::put('images', $images);

    }

    public function ajax_add_product(Request $request){
        
        $title = $request->title;
        $description = $request->description;
        $price = $request->price;
        $old_price = $request->old_price ?? -1;
        $category = $request->category;
        $sub_category = $request->sub_category ?? '';
        $images = Session::get('images');
        $priority = $request->priority ?? '';
        $video = $request->video ?? '';

        Products::create([
            'title' => $title,
            'description' => $description,
            'category' => $category,
            'sub_category' => $sub_category,
            'price' => $price,
            'old_price' => $old_price,
            'priority' => $priority,
            'images' => $images,
            'video' => $video,
        ]);

        Session::put('images', '');

    }


    public function ajax_modify_product(Request $request){

        $title = $request->title;
        $description = $request->description;
        $price = $request->price;
        $old_price = $request->old_price ?? -1;
        $category = $request->category;
        $sub_category = $request->sub_category ?? '';
        $images = Session::get('images');
        $priority = $request->priority ?? '';
        $id = $request->id;
        $video = $request->video ?? '';

        Products::where('id', $id)->update([
            'title' => $title,
            'description' => $description,
            'category' => $category,
            'sub_category' => $sub_category,
            'price' => $price,
            'old_price' => $old_price,
            'priority' => $priority,
            'images' => $images,
            'video' => $video,
        ]);

        Session::put('images', '');

    }


    public function ajax_delete_product(Request $request){
        $id = $request->id;

        Products::where('id', '=', $id)->delete();
    }

    public function admin_open_product(Request $request){

        if(Session::get('admin_loggedIn') !== 'true'){
            return view('admin_login');
        }

        $id = $request->id;
        $wantedProduct = null;
        $all_products = Products::get();
        for ($i=0; $i < sizeof($all_products); $i++) { 
            if($all_products[$i]->id == $id){
                $wantedProduct = $all_products[$i];
            }
        }

        Session::put('images', $wantedProduct->images);

        $wantedProduct->images = explode(",,,", $wantedProduct->images);
        
        $wantedProduct->video = strval($wantedProduct->video);

        return view('admin.modify_product',[
            'wantedProduct' => $wantedProduct,
        ]);

    }


    public function ajax_delete_image(Request $request){

        $image = $request->image;
        $images = Session::get("images");
        $images = explode(",,,", $images);
        $wantedImages = "";
        for ($i=0; $i < sizeof($images); $i++) { 
            if($images[$i] !== $image){
                if(strlen($wantedImages) == 0){
                    $wantedImages = $images[$i];
                }
                else{
                    $wantedImages .= ",,," . $images[$i];
                }
            }
        }
        Session::put("images", $wantedImages);

    }

    public function admin_orders_get(){

        if(Session::get('admin_loggedIn') !== 'true'){
            return view('admin_login');
        }

        $all_orders = Orders::get();

        for ($i=0; $i < sizeof($all_orders); $i++) { 
            $created_at = explode(" ", $all_orders[$i]->created_at);
            $created_at = $created_at[0];
            $all_orders[$i]->date_created = $created_at;
        }

        $new_orders = array();
        $paid_orders = array();
        $shipped_orders = array();
        $delivered_orders = array();

        for ($i=0; $i < sizeof($all_orders); $i++) { 
            if($all_orders[$i]->status == "Processing"){
                array_push($new_orders, $all_orders[$i]);
            }
            else if($all_orders[$i]->status == "Paid"){
                array_push($paid_orders, $all_orders[$i]);
            }
            else if($all_orders[$i]->status == "Shipped"){
                array_push($shipped_orders, $all_orders[$i]);
            }
            else{
                array_push($delivered_orders, $all_orders[$i]);
            }
        }
        
        return view('admin.admin_manage_orders',[
            'all_orders' => $all_orders,
            'new_orders' => $new_orders,
            'paid_orders' => $paid_orders,
            'shipped_orders' => $shipped_orders,
            'delivered_orders' => $delivered_orders,
        ]);

    }


    public function admin_open_order(Request $request){

        if(Session::get('admin_loggedIn') !== 'true'){
            return view('admin_login');
        }

        $id = $request->id;
        $wanted_order = null;
        $all_orders = Orders::get();
        $all_products = Products::get();

        for ($i=0; $i < sizeof($all_orders); $i++) { 
            $created_at = explode(" ", $all_orders[$i]->created_at);
            $created_at = $created_at[0];
            $all_orders[$i]->date_created = $created_at;
        }

        for ($i=0; $i < sizeof($all_orders); $i++) { 
            if($all_orders[$i]->id == $id){
                $wanted_order = $all_orders[$i];
            }
        }

        $order_details = $wanted_order->order_details;

        $items = explode(",,,", $order_details);
        
        $items_class_arr = array();

        foreach ($items as $key => $item) {

            array_push($items_class_arr, new Items);

            $parts = explode(",", $item);

            $parts_id = $parts[0];
            $item_id = substr($parts_id, strpos($parts_id, "_") + 1);
            $items_class_arr[$key]->id = $item_id;
            
            $parts_price = $parts[1];
            $item_price = substr($parts_price, strpos($parts_price, "_") + 1);
            $items_class_arr[$key]->price = $item_price;
            
            $parts_quantity = $parts[2];
            $item_quantity = substr($parts_quantity, strpos($parts_quantity, "_") + 1);
            $items_class_arr[$key]->quantity = $item_quantity;
            
            $parts_amount = $parts[3];
            $item_amount = substr($parts_amount, strpos($parts_amount, "_") + 1);
            $items_class_arr[$key]->amount = $item_amount;

        }


        for ($i=0; $i < sizeof($items_class_arr); $i++) { 
            foreach ($all_products as $key => $product) {
                if($product->id == $items_class_arr[$i]->id){
                    $items_class_arr[$i]->images = $product->images;
                    $items_class_arr[$i]->mainImage = explode(",,,", $items_class_arr[$i]->images)[0];
                }
            }
        }

        return view('admin.admin_open_order',[
            'wanted_order' => $wanted_order,
            'items_class_arr' => $items_class_arr,
            'id' => $id,
        ]);

    }

    public function ajax_update_order_statues(Request $request){

        $status = $request->status;
        $id = $request->id;
        $all_orders = Orders::get();

        Orders::where('id', $id)
                ->update([
                    'status' => $status,
                ]);
    }

}
