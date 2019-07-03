<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use \App\VirtuemartProductsRu;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $uid = (int)$request->input('uid');
        $limit = (int)$request->input('limit');
        $offset = (int)$request->input('offset');
        $categoryid = (int)$request->input('categoryid');
        $sort = $request->input('sort');
        
        if($sort == 'on'){
            $sort = 'asc';
        } else {
            $sort = 'desc';
        }
        
        $products = DB::table('bxtnj_virtuemart_product_categories')
        ->where('bxtnj_virtuemart_product_categories.virtuemart_category_id', '=', $categoryid)
        ->orderBy('id', $sort)->get();
        
        
        $arr = array();
        $i = 0;
        foreach($products as $product) {
            $product = VirtuemartProductsRu::orderBy('virtuemart_product_id', 'desc')
            ->where('virtuemart_product_id', '=', $product->virtuemart_product_id)
            ->first();
            
            $arr[$i]['id'] = $product->virtuemart_product_id;
            $arr[$i]['product_name'] = $product->product_sku;
            
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
        
        if($arr === Array()){
            return $this->getcategoryies($categoryid);
        } else {
           return $this->result($arr);
        }

    }
    
    protected function getcategoryies($categoryid){
        $categoryes = DB::table('bxtnj_virtuemart_category_categories')
        ->leftJoin('bxtnj_virtuemart_categories_ru_ru', 'bxtnj_virtuemart_categories_ru_ru.virtuemart_category_id', '=', 'bxtnj_virtuemart_category_categories.category_child_id')
        ->where('bxtnj_virtuemart_category_categories.category_parent_id', '=', $categoryid)->get();
        
        $arrcategories = array();
        $i = 0;
        foreach($categoryes as $category) {
            $arrcategories[$i]['id'] = $category->id;
            $arrcategories[$i]['name'] = $category->category_name;
            $i = $i + 1;
        }
        
        return $arrcategories;
    }
}