<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use \App\VirtuemartProducts;

class NewItemsController extends Controller
{
    public function index(Request $request)
    {
        $offset = (int)$request->input('offset');
        $limit = (int)$request->input('limit');
        
        $products = VirtuemartProducts::orderBy('virtuemart_product_id', 'desc')->offset($offset)->limit($limit)->get();
        
        $arr = array();
        $i = 0;
        foreach($products as $product){
            $arr[$i]['id'] = $product->virtuemart_product_id;
            $arr[$i]['product_sku'] = $product->product_sku;
            
            $arrmedia = array();
            foreach ($product->medias as $media){
                $arrmedia[] = $media->file_url;
            }
            $arr[$i]['images'] = $arrmedia;
            
            $brand = DB::table('bxtnj_virtuemart_product_manufacturers')
            ->leftJoin('bxtnj_virtuemart_manufacturers_ru_ru', 'bxtnj_virtuemart_product_manufacturers.virtuemart_manufacturer_id', '=', 'bxtnj_virtuemart_manufacturers_ru_ru.virtuemart_manufacturer_id')
            ->where('bxtnj_virtuemart_product_manufacturers.virtuemart_product_id', '=', $product->virtuemart_product_id)->first();
            
            $arr[$i]['brand'] = $brand->mf_name;
            
            $i = $i + 1;
        }
        
        return $arr;
    }
}