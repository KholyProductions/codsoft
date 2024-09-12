<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Wallpapers;
use App\Models\Products;
use App\Models\Maintenance;
use App\Models\Orders;

use Session;

class HomeController extends FunctionsController
{
    
    public function index_get(){


        $admin_loggedIn = Session::get('admin_loggedIn') ?? 'false';
        $all_maintenances = Maintenance::get();
        $maintenance_status = $all_maintenances[0]->status;
        if($maintenance_status == 'on' && $admin_loggedIn == 'false'){
            return view('maintenance');
        }

        $all_wallpapers = Wallpapers::get();

        $newArrival_products = $this->getProducts('', '', 'new', 16, null);
        $topSelling_products = $this->getProducts('', '', 'top', 16, null);
        $cardio_products = $this->getProducts('cardio', '', '', 16, null);
        $gym_products = $this->getProducts('gym_equipment', '', '', 16, null);
        $accessories_products = $this->getProducts('accessories', '', '', 16, null);

        
        
        
        $cart_count = Session::get('cart_count') ?? 0;

        return view('home',[
            'all_wallpapers' => $all_wallpapers,
            'cardio_products' => $cardio_products,
            'topSelling_products' => $topSelling_products,
            'newArrival_products' => $newArrival_products,
            'gym_products' => $gym_products,
            'accessories_products' => $accessories_products,
            'cart_count' => $cart_count,
        ]);
    }



    public function product_show(Request $request){

        $admin_loggedIn = Session::get('admin_loggedIn') ?? 'false';
        $all_maintenances = Maintenance::get();
        $maintenance_status = $all_maintenances[0]->status;
        if($maintenance_status == 'on' && $admin_loggedIn == 'false'){
            return view('maintenance');
        }

        $id = $request->id;
        $all_products = Products::get();
        $wantedProduct = null;

        for ($i=0; $i < sizeof($all_products); $i++) { 
            if($all_products[$i]->id == $id){
                $images = $all_products[$i]->images;
                $images = explode(",,,", $images);
                $all_products[$i]->mainImage = $images[0];
                $all_products[$i]->images = explode(',,,', $all_products[$i]->images);
                $wantedProduct = $all_products[$i];
                
            }
        }

        if($wantedProduct == null){
            abort(404);
        }

        $wantedProduct->description = nl2br($wantedProduct->description);

        $related_products = $this->getProducts($wantedProduct->category, '', '', 16, $wantedProduct->id);
        $newArrival_products = $this->getProducts('', '', 'new', 16, $wantedProduct->id);
        $topSelling_products = $this->getProducts('', '', 'top', 16, $wantedProduct->id);

        $cart_count = Session::get('cart_count') ?? 0;

        return view('product_show',[
            'wantedProduct' => $wantedProduct,
            'newArrival_products' => $newArrival_products,
            'related_products' => $related_products,
            'cart_count' => $cart_count,
            'topSelling_products' => $topSelling_products,
        ]);

    }   


    public function products_all(){

        $admin_loggedIn = Session::get('admin_loggedIn') ?? 'false';
        $all_maintenances = Maintenance::get();
        $maintenance_status = $all_maintenances[0]->status;
        if($maintenance_status == 'on' && $admin_loggedIn == 'false'){
            return view('maintenance');
        }

        $all_products = $this->getProducts('', '', '', null, null);
        $wantedProducts = array();
        $cart_count = Session::get('cart_count') ?? 0;

        for ($i=sizeof($all_products)-1; $i > -1 ; $i--) { 
            array_push($wantedProducts, $all_products[$i]);
        }

        return view('products',[
            'wantedProducts' => $wantedProducts,
            'genre' => '',
            'search' => '',
            'cart_count' => $cart_count,
        ]);

    }

    public function products_top(){

        $admin_loggedIn = Session::get('admin_loggedIn') ?? 'false';
        $all_maintenances = Maintenance::get();
        $maintenance_status = $all_maintenances[0]->status;
        if($maintenance_status == 'on' && $admin_loggedIn == 'false'){
            return view('maintenance');
        }
        
        $wantedProducts = $this->getProducts('', '', 'top', null, null);
        $cart_count = Session::get('cart_count') ?? 0;

        

        return view('products',[
            'wantedProducts' => $wantedProducts,
            'genre' => 'Top Selling',
            'search' => '',
            'cart_count' => $cart_count,
        ]);
    }

    public function products_new(){

        $admin_loggedIn = Session::get('admin_loggedIn') ?? 'false';
        $all_maintenances = Maintenance::get();
        $maintenance_status = $all_maintenances[0]->status;
        if($maintenance_status == 'on' && $admin_loggedIn == 'false'){
            return view('maintenance');
        }
        
        $wantedProducts = $this->getProducts('', '', 'new', null, null);
        $cart_count = Session::get('cart_count') ?? 0;

        

        return view('products',[
            'wantedProducts' => $wantedProducts,
            'genre' => 'New Arrivals',
            'cart_count' => $cart_count,
            'search' => '',
        ]);
    }


    public function products_category(Request $request){

        $admin_loggedIn = Session::get('admin_loggedIn') ?? 'false';
        $all_maintenances = Maintenance::get();
        $maintenance_status = $all_maintenances[0]->status;
        if($maintenance_status == 'on' && $admin_loggedIn == 'false'){
            return view('maintenance');
        }

        $cart_count = Session::get('cart_count') ?? 0;
        $category = $request->category;

        $wantedProducts = $this->getProducts($category, '', '', null, null);
        $topSelling_products = $this->getProducts('', '', 'top', 16, null);

        if(sizeof($wantedProducts) == 0){
            abort(404);
        }

        $genre = '';
        if($category == 'gym_equipment'){
            $genre = "Gym Equipment";
        }
        if($category == 'cardio'){
            $genre = "Cardio";
        }
        if($category == 'sports'){
            $genre = "Sports";
        }
        if($category == 'accessories'){
            $genre = "Accessories";
        }


        return view('products',[
            'topSelling_products' => $topSelling_products,
            'wantedProducts' => $wantedProducts,
            'genre' => $genre,
            'cart_count' => $cart_count,
            'search' => '',
        ]);

    }

    public function products_search(Request $request){

        $admin_loggedIn = Session::get('admin_loggedIn') ?? 'false';
        $all_maintenances = Maintenance::get();
        $maintenance_status = $all_maintenances[0]->status;
        if($maintenance_status == 'on' && $admin_loggedIn == 'false'){
            return view('maintenance');
        }

        $cart_count = Session::get('cart_count') ?? 0;
        $genre = '';
        $search = $request->search;
        $search = strtolower($search);
        $all_products = $this->getProducts('', '', '', null, null);
        $topSelling_products = $this->getProducts('', '', 'top', 16, null);
        $wantedProducts = array();
        for ($i=0; $i < sizeof($all_products); $i++) { 
            $title = strtolower($all_products[$i]->title);
            if(str_contains($title, $search)){
                array_push($wantedProducts, $all_products[$i]);
            }
        }

        return view('products',[
            'wantedProducts' => $wantedProducts,
            'genre' => $genre,
            'cart_count' => $cart_count,
            'search' => $search,
            'topSelling_products' => $topSelling_products,
        ]);

    }


    public function contact_get(){
        $admin_loggedIn = Session::get('admin_loggedIn') ?? 'false';
        $all_maintenances = Maintenance::get();
        $maintenance_status = $all_maintenances[0]->status;
        if($maintenance_status == 'on' && $admin_loggedIn == 'false'){
            return view('maintenance');
        }
        
        $cart_count = Session::get('cart_count') ?? 0;

        

        return view('contact',[
            'cart_count' => $cart_count,
            'msg' => '',
        ]);
    }


    public function contact_post(Request $request){

        $cart_count = Session::get('cart_count') ?? 0;

        $name = $request->name_input;
        $email = $request->email_input;
        $message = $request->message_input;
        $phone = $request->phone_input;

        if(strlen($name) > 0 && strlen($email) > 0 && strlen($message) > 0 && strlen($phone) > 0){
            $msg = "Name: " . $name . "\r\n" . "Email: " . $email . "\r\n" . "Phone: " . $phone . "\r\n" . "Message: " . $message;
            mail('kholyproductions@gmail.com', 'New Message from GET FIT', $msg);
            return view('contact',[
                'cart_count' => $cart_count,
                'msg' => 'success',
            ]);
        }

        return view('contact',[
            'cart_count' => $cart_count,
            'msg' => 'fail',
        ]);
        
    }


    public function about(){

        $cart_count = Session::get('cart_count') ?? 0;

        return view('about',[
            'cart_count' => $cart_count,
        ]);
    }

    public function terms(){

        $cart_count = Session::get('cart_count') ?? 0;

        return view('terms',[
            'cart_count' => $cart_count,
        ]);
    }

    public function privacy(){

        $cart_count = Session::get('cart_count') ?? 0;

        return view('privacy',[
            'cart_count' => $cart_count,
        ]);
    }




}
