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
        $arr['name'] = $product->ru->product_name;
        $arr['description'] = $product->ru->product_desc;
        $arr['brand'] = $product->manufacturer->ru->mf_name;
        
        return $this->result($arr);
    }
    
}