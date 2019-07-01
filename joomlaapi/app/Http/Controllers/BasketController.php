<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use \App\Orders;

class BasketController extends Controller
{

    public function index(Request $request)
    {        
        $uid = (int)$request->input('uid');
        
        $order = Orders::where('user_id', $uid)->count();
        if($order == 0):
            $order = new Orders;
            $order->user_id = $uid;
            $order->save(['timestamps' => false ]);
            
            return $this->result(0);
        endif;
        
        $order = Orders::where('user_id', $uid)->first();
        
        $arr = array();
        foreach ($order->products as $product) {
            $arr['virtuemart_product_id'] = $product->virtuemart_product_id;
            $arr['name'] = $product->product_sku;
            $arrmedia = array();
            foreach ($product->medias as $media){
                $arrmedia[] = $media->file_title;
            }
            $arr['images'] = $arrmedia;
            $brand = DB::table('bxtnj_virtuemart_product_manufacturers')
            ->leftJoin('bxtnj_virtuemart_manufacturers_ru_ru', 'bxtnj_virtuemart_product_manufacturers.virtuemart_manufacturer_id', '=', 'bxtnj_virtuemart_manufacturers_ru_ru.virtuemart_manufacturer_id')
            ->where('bxtnj_virtuemart_product_manufacturers.virtuemart_product_id', '=', $product->virtuemart_product_id)->first();
            $arr['brand'] = $brand;
        }
        
        
        return $this->result($arr);
    }
    
    protected function errors($error){
        switch ($error) {
            case 1:
                $errormsg = 'Данные не найдены';
                break;
            }
            
        return $this->result(array('error'=>array('code'=>$error, 'message'=>$errormsg)));
    }
    
}