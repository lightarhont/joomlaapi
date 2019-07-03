<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use \App\Orders;
use \App\OrderVirtuemart;

class PlaceOrderController extends Controller
{
    public function index(Request $request)
    {
        $data = array();
        $uid = (int)$request->input('uid');
        
        $data['first_name'] = $request->input('first_name');
        $data['middle_name'] = $request->input('middle_name');
        $data['last_name'] = $request->input('last_name');
        $data['name'] = $data['first_name'] . ' ' . $data['middle_name'] . ' ' . $data['last_name'];
        $data['virtuemart_country_id'] = (int)$request->input('countryid');
        $data['virtuemart_state_id'] = (int)$request->input('stateid');
        $data['zip'] = $request->input('zip');
        $data['city'] = $request->input('city');
        $data['address_1'] = $request->input('address_1');
        $data['address_2'] = $request->input('address_2');
        $data['phone_1'] = $request->input('phone1');
        $data['phone_2'] = $request->input('phone2');
        
        $order = Orders::where('user_id', $uid)->first();
        
        $arr = array();
        $i = 0;
        
        foreach ($order->products as $product) {
            $arr[$i]['virtuemart_product_id'] = $product->virtuemart_product_id;
            $arr[$i]['quantity'] = $product->pivot->quantity;
        }
        
        
        $ov = new OrderVirtuemart;
        $ov->virtuemart_user_id = $uid;
        $ov->ip_address  = $this->getip();
        $ov->save();
        
        
    }
    
    public function getip(){
                if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

return $ip;
    }

}