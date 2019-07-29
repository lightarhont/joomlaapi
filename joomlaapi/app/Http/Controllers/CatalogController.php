<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use \App\VirtuemartProducts;
use \App\VirtuemartProductPrice;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $uid = (int)$request->input('uid');
        $limit = (int)$request->input('limit');
        $offset = (int)$request->input('offset');
        $categoryid = (int)$request->input('categoryid');
        $sort = $request->input('sort');
        
        $productscount = DB::table('bxtnj_virtuemart_product_categories')
        ->where('bxtnj_virtuemart_product_categories.virtuemart_category_id', '=', $categoryid)
        ->skip($offset)->take($limit)->count();
        
        if($productscount == 0){
            return $this->getcategoryies($categoryid);
        } else {
            $products = DB::table('bxtnj_virtuemart_product_categories')
            ->where('bxtnj_virtuemart_product_categories.virtuemart_category_id', '=', $categoryid)
            ->skip($offset)->take($limit)->get();
            return $this->sortproducts($products, $sort);
        }

    }
    
    protected function sortproducts($products, $sort){
        
        $arr = array();
        foreach($products as $product){
            $arr[] = $product->virtuemart_product_id;
        }
        
        switch($sort){
            case 0:
                return $this->getproducts($arr, 'asc');
                break;
            case 1:
                return $this->getproducts($arr, 'desc');
                break;
            case 2:
                return $this->getproductsbyprice($arr, 'asc');
                break;
            case 3:
                return $this->getproductsbyprice($arr, 'desc');
                break;
            case 4:
                return $this->getproducts($arr, 'asc');
                break;
        }    
    }
    
    protected function getproductsbyprice($products, $sort){
        $pps = VirtuemartProductPrice::whereIn('virtuemart_product_id', $products)->orderBy('product_price', $sort)->get();
        
        $arr = array();
        $i = 0;
        foreach ($pps as $pp) {
            
            $arr[$i]['virtuemart_product_id'] = $pp->product->virtuemart_product_id;
            $arr[$i]['name'] = $pp->product->ru->product_name;
            $arrmedia = array();
            
            foreach ($pp->product->medias as $media){
                $arrmedia[] = $media->file_url;
            }
            
            $arr[$i]['images'] = $arrmedia;
            
            $arr[$i]['brand'] = $pp->product->manufacturer->ru->mf_name;

            $arr[$i]['price'] = $pp->product_price;
            
            $arr[$i]['params'] = json_decode($pp->product->fiels->custom_param);
            
            $i = $i + 1;
        }
        
        return $arr;
        
    }
    
    protected function getproducts($products, $sort){
        return $this->iterproducts(VirtuemartProducts::whereIn('virtuemart_product_id', $products)
                    ->orderBy('virtuemart_product_id', $sort)->get());
    }
    
    protected function getcategoryies($categoryid){
        $categoryes = DB::table('bxtnj_virtuemart_category_categories')
        ->leftJoin('bxtnj_virtuemart_categories', 'bxtnj_virtuemart_categories.virtuemart_category_id', '=', 'bxtnj_virtuemart_category_categories.category_child_id')
        ->leftJoin('bxtnj_virtuemart_categories_ru_ru', 'bxtnj_virtuemart_categories_ru_ru.virtuemart_category_id', '=', 'bxtnj_virtuemart_category_categories.category_child_id')
        ->where('bxtnj_virtuemart_categories.published', '=', 1)
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