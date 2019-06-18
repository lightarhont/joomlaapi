<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BasketController extends Controller
{

    public function index(Request $request)
    {        
        $uid = $request->input('uid');
        
        $data = DB::table('bxtnj_session')->where('userid', '=', $uid)->first();
        
        if($data != null):
            $raw_data = str_replace('\0\0\0', chr(0) . '*' . chr(0), (string)$data->data);
            $raw_data = explode('|',$raw_data);
        
        
            $data = array();
        
            for( $idx = 1, $ic=count($raw_data); $idx<$ic; $idx++ ) {
                $data[$idx] = unserialize($raw_data[$idx]);
            }
            $cart = unserialize($data[2]['vmcart']);
        
            $resultarray = array();
            
            foreach($cart->products as $product) {
                $table = 'bxtnj_virtuemart_manufacturers_ru_ru';
                $brand = DB::table($table)->where('virtuemart_manufacturer_id', '=', $product->virtuemart_manufacturer_id)->first();
                $resultarray['brand'] = $brand->mf_name;
                $resultarray['product_price'] = $product->product_price;
                $resultarray['product_name'] = $product->product_name;
                $resultarray['quantity'] = $product->quantity;
            }
            return $resultarray;
        else:
            return $this->errors(1);
        endif;
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