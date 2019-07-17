<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use \App\VirtuemartProducts;

class ProductController extends Controller
{
    
    public function index(Request $request)
    {
        $productid = (int)$request->input('id');
        $uid = (int)$request->input('uid');
        
        $product = VirtuemartProducts::where('virtuemart_product_id', '=', $productid)->first();
        
        $arr = array();
        $arr['id'] = $product->virtuemart_product_id;
        $arr['name'] = $product->ru->product_name;
        $arr['description'] = $product->ru->product_desc;
        $arr['brand'] = $product->manufacturer->ru->mf_name;
        $arr['price'] = $product->price->product_price;
        if($product->fiels->custom_param != '') {
            $arr['fields'] = json_decode($product->fiels->custom_param);
        } else {
            $arr['fields'] = False;
        }
        
        foreach ($product->medias as $media){
            $arrmedia[] = $media->file_url;
        }
            
        $arr['images'] = $arrmedia;
        
        if($product->rating != null){
            
            $arr['rating'] = $product->rating;
            
        } else {
            $arr['rating'] = null;
        }
        
        return $this->result($arr);
    }
    
}