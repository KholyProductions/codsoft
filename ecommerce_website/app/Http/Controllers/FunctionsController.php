<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Products;

class FunctionsController extends Controller
{
    
    public function getProducts($category, $sub_category, $priority, $length, $excluded_id){

        $all_products = Products::get();
        $wantedProducts_arr = array();

        for ($i=0; $i < sizeof($all_products); $i++) { 
            if(($all_products[$i]->category == $category || $category == '')
            && ($all_products[$i]->sub_category == $sub_category || $sub_category == '')
            && (str_contains($all_products[$i]->priority, $priority) || $priority == '')
            && ($all_products[$i]->id !== $excluded_id || $excluded_id == null)){

                $images = $all_products[$i]->images;
                $images = explode(",,,", $images);
                $all_products[$i]->mainImage = $images[0];

                array_push($wantedProducts_arr, $all_products[$i]);
            }
        }

        if($length !== null){
            $wantedProducts_arr = array_slice($wantedProducts_arr, 0, $length);
        }

        return $wantedProducts_arr;

    }

}
