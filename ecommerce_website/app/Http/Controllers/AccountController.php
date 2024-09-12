<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Products;
use App\Models\Orders;
use App\Models\Account;
use App\Models\Items;

use Session;

class AccountController extends Controller
{
    

    public function ajax_add_cart(Request $request){
        $id = $request->id;

        $cart_items = Session::get('cart_items') ?? '';

        if(strlen($cart_items) == 0){
            $cart_items .= $id;
        }
        else{
            $cart_items .= ",,," . $id;
        }

        Session::put('cart_items', $cart_items);

        $cart_explode = explode(",,,", $cart_items);
        $cart_count = 0;
        for ($i=0; $i < sizeof($cart_explode); $i++) { 
            if(strlen($cart_explode[$i]) > 0){
                $cart_count++;
            }
        }

        Session::put('cart_count', $cart_count);

        echo $cart_count;
    }


    public function getCart_arr(){

        $cart_items = Session::get('cart_items') ?? '';

        $cart_id_arr = explode(",,,", $cart_items);

        $cart_arr = array();


        $all_products = Products::get();

        foreach ($cart_id_arr as $key => $id) {
            for ($i=0; $i < sizeof($all_products); $i++) { 
                if($all_products[$i]->id == $id){
                    array_push($cart_arr, $all_products[$i]);
                }
            }
        }

        for ($i=0; $i < sizeof($cart_arr); $i++) { 
            $images = $cart_arr[$i]->images;
            $images = explode(",,,", $images);
            $cart_arr[$i]->mainImage = $images[0];
        }


        return $cart_arr;
    }


    public function checkout_get(){

        $cart_items = Session::get('cart_items') ?? '';

        $cart_id_arr = explode(",,,", $cart_items);

        $cart_arr = $this->getCart_arr();

        $name = Session::get('name') ?? '';
        $email = Session::get('email') ?? '';
        $phone = Session::get('phone') ?? '';
        $city = Session::get('city') ?? '';
        $address = Session::get('address') ?? '';
        $cart_count = Session::get('cart_count') ?? 0;

        return view('checkout',[
            'cart_arr' => $cart_arr,
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'city' => $city,
            'address' => $address,
            'cart_id_arr' => $cart_id_arr,
            'cart_count' => $cart_count,
        ]);
    }



    public function remove_cart_item(Request $request){

        $id = $request->id;
        $id_string = $id;
        $cart_items_list = Session::get('cart_items');
        $final_cart_items_arr = explode($id_string, $cart_items_list);
        $final_cart_items;
        if(sizeof($final_cart_items_arr) > 1){
            $final_cart_items = $final_cart_items_arr[0] . $final_cart_items_arr[1];
        }
        else{
            $final_cart_items = $final_cart_items_arr[0];
        }
        
        Session::put('cart_items', $final_cart_items);

        $cart_explode = explode(",,,", $final_cart_items);
        $cart_count = 0;
        for ($i=0; $i < sizeof($cart_explode); $i++) { 
            if(strlen($cart_explode[$i]) > 0){
                $cart_count++;
            }
        }

        Session::put('cart_count', $cart_count);

    }


    public function submit_order(Request $request){

        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;
        $city = $request->city;
        $address = $request->address;
        $order_details = $request->order_details;
        $shipping = (int)$request->shipping;
        $notes = $request->notes ?? '';
        $status = $request->status;
        $total = (int)$request->total;
        $tracking_id = $this->generateRandomString();

        Orders::create([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'city' => $city,
            'address' => $address,
            'order_details' => $order_details,
            'shipping' => $shipping,
            'notes' => $notes,
            'status' => $status,
            'total' => $total,
            'tracking_id' => $tracking_id,
            'phone_payment' => '',
        ]);

        //Session::put('cart_items', '');
        //Session::put('cart_count', '');


        $all_orders = Orders::get();
        $order_id = sizeof($all_orders)-1;

        Session::put('name', $name);
        Session::put('email', $email);
        Session::put('phone', $phone);
        Session::put('city', $city);
        Session::put('address', $address);
        Session::put('total', $total);
        Session::put('order_id', $order_id);
        Session::put('tracking_id', $tracking_id);

        //send email with password here
        $myOrderMsg = 'Name: ' . $name . "\r\n" . "Email: " . $email . "\r\n" . "Phone: " . $phone . "\r\n" . "City: " . $city . "\r\n" . "Order Details: " . $order_details . "\r\n" . 'Total: ' .$total;
        //mail('hazemelkholy1@gmail.com', 'New Order from Get Fit', $myOrderMsg);


        

    }

    public function generateRandomString() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 10; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    public function getItems($order){

        $all_orders = Orders::get();
        $all_products = Products::get();

        $order_details = $order->order_details;

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
                    $images = explode(",,,", $product->images);
                    $items_class_arr[$i]->mainImage = $images[0];
                }
            }
        }

        return $items_class_arr;

        

    }

    

    public function payment_get(){

        $cart_count = Session::get('cart_count') ?? 0;
        $total = Session::get('total') ?? 0;
        $method = $_GET['type'] ?? "mobile";
        $tracking_id = Session::get('tracking_id') ?? '';

        


        return view('payment',[
            'cart_count' => $cart_count,
            'total' => $total,
            'method' => $method,
            'tracking_id' => $tracking_id,
        ]);

    }


    public function ajax_update_phone_payment(Request $request){

        $order_id = Session::get('order_id');
        $phone_payment = $request->phone_payment;

        Session::put('cart_items', '');
        Session::put('cart_count', 0);

        $tracking_id = Session::get('tracking_id') ?? '';
        $total = Session::get('total') ?? 0;
        $name = Session::get('name') ?? '';
        $email = Session::get('email') ?? '';
        $phone = Session::get('phone') ?? '';

        $myOrderMsg = "Name: " . $name . "\r\n" . "Phone: " . $phone . "\r\n" . "Phone Payment: " . $phone_payment . "\r\n" . "Order ID: " . $order_id;
        $userOrderMsg = "Thank you for your order " .  "\r\n" . "Order Total: " . $total . " EGP" . "\r\n" . "Tracking Code: " . $tracking_id . "\r\n" . "If you have any questions please do not hesitate to contact us, and we will be more than happy to assist you." . "\r\n" . "\r\n" . "+2 01211375575" . "\r\n" . "info@getfit-egypt.com" . "\r\n" . "Get Fit Egypt";

        //mail('hazemelkholy1@gmail.com', 'New Payment from Get Fit', $myOrderMsg);
        //mail($email, 'Get Fit Egypt - Thank you for your order', $userOrderMsg);

        Orders::where('id', $order_id)
        ->update([
            'phone_payment' => $phone_payment,
        ]);

    }

    public function thankyou(){

        $tracking_id = $_GET['track'] ?? '';
        if($tracking_id == ''){
            return view('thankyou',[
                'wantedOrder' => null,
                'cart_count' => 0,
            ]);
        }

        $wantedOrder = null;
        $all_orders = Orders::get();
        for ($i=0; $i < sizeof($all_orders); $i++) { 
            if($all_orders[$i]->tracking_id == $tracking_id){
                $wantedOrder = $all_orders[$i];
            }
        }

        if($wantedOrder == null){
            abort(404);
        }

        if($wantedOrder->status == "Paid"){
            $wantedOrder->status = "Preparing";
        }

        return view('thankyou',[
            'wantedOrder' => $wantedOrder,
            'cart_count' => 0,
        ]);

    }

    public function ajax_track_shipment(Request $request){

        $tracking_id = $request->tracking_id;

        $all_orders = Orders::get();

        $wantedOrder = null;
        for ($i=0; $i < sizeof($all_orders); $i++) { 
            if($all_orders[$i]->tracking_id == $tracking_id){
                $wantedOrder = $all_orders[$i];
            }
        }

        if($wantedOrder == null){
            echo 'null';
        }
        else{
            echo $tracking_id;
        }

    }



    public function register(){
        
        $cart_count = Session::get('cart_count') ?? 0;

        return view('register',[
            'cart_count' => $cart_count,
        ]);
    }


    public function login(){
        
        $cart_count = Session::get('cart_count') ?? 0;

        return view('login',[
            'cart_count' => $cart_count,
        ]);
    }

    public function account(){
        
        $cart_count = Session::get('cart_count') ?? 0;

        $name = Session::get('name') ?? '';
        $email = Session::get('email') ?? '';
        $phone = Session::get('phone') ?? '';
        $password = Session::get('password') ?? '';
        $city = Session::get('city') ?? '';
        $address = Session::get('address') ?? '';

        if($email == ''){
            return view('login',[
                'cart_count' => $cart_count,
            ]);
        }

        $wantedOrders_arr = $this->getWantedOrders_arr();
        $wantedOrders = array();

        for ($i=0; $i < sizeof($wantedOrders_arr); $i++) { 
            array_push($wantedOrders,$this->getItems($wantedOrders_arr[$i]));
        }

        return view('account',[
            'cart_count' => $cart_count,
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'password' => $password,
            'address' => $address,
            'city' => $city,
            'wantedOrders' => $wantedOrders,
            'wantedOrders_arr' => $wantedOrders_arr,
        ]);
    }



    public function getWantedOrders_arr(){
        $email = Session::get('email');
        $all_orders = Orders::get();
        $wantedOrders_arr = array();

        for ($i=0; $i < sizeof($all_orders); $i++) { 
            if($all_orders[$i]->email == $email){
                array_push($wantedOrders_arr, $all_orders[$i]);
            }
        }
        return $wantedOrders_arr;
    }


    public function ajax_login(Request $request){

        $all_accounts = Account::get();

        $email = $request->email ?? '';
        $password = $request->password ?? '';
        
        for ($i=0; $i < sizeof($all_accounts); $i++) { 
            if($all_accounts[$i]->email == $email && $all_accounts[$i]->password == $password){
                
                Session::put('name', $all_accounts[$i]->name);
                Session::put('email', $all_accounts[$i]->email);
                Session::put('phone', $all_accounts[$i]->phone);
                Session::put('password', $all_accounts[$i]->password);
                Session::put('city', $all_accounts[$i]->city);
                Session::put('address', $all_accounts[$i]->address);
                echo 'login_success';
                return;
            }
        }

        echo 'invalid';

    }


    public function ajax_register(Request $request){

        $name = $request->name ?? '';
        $email = $request->email ?? '';
        $phone = $request->phone ?? '';
        $password = $request->password ?? '';
        $city = $request->city ?? '';
        $address = $request->address ?? '';

        $all_accounts = Account::get();

        for ($i=0; $i < sizeof($all_accounts); $i++) { 
            if($all_accounts[$i]->email == $email){
                echo 'already_exists';
                return;
            }
        }


        if(strlen($name) > 0 && filter_var($email, FILTER_VALIDATE_EMAIL) && strlen($phone) > 0 && strlen($password) > 5 && strlen($city) > 0 && strlen($address) > 0){
            
            Account::create([
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'password' => $password,
                'city' => $city,
                'address' => $address,
            ]);

            Session::put('name', $name);
            Session::put('email', $email);
            Session::put('phone', $phone);
            Session::put('password', $password);
            Session::put('city', $city);
            Session::put('address', $address);

            echo 'login_success';
            return;
        }
        else{
            echo 'missing_information';
        }


        
    }



    public function ajax_update_personal_information(Request $request){

        
        $name = $request->name ?? '';
        $email = Session::get('email') ?? '';
        $phone = $request->phone ?? '';
        $password = $request->password ?? '';
        $city = $request->city ?? '';
        $address = $request->address ?? '';

        Session::put('name', $name);
        Session::put('phone', $phone);
        Session::put('password', $password);
        Session::put('city', $city);
        Session::put('address', $address);

        Account::where('email', $email)
                ->update([
                    'name' => $name,
                    'password' => $password,
                    'phone' => $phone,
                    'city' => $city,
                    'address' => $address,
                ]);

    }


    public function ajax_signout(){

        Session::put('name', '');
        Session::put('email', '');
        Session::put('phone', '');
        Session::put('password', '');
        Session::put('city', '');
        Session::put('address', '');
        Session::put('cart_count', 0);
        Session::put('cart_items', '');

        
    }

}
