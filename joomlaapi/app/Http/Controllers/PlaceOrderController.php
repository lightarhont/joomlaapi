<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use \App\Orders;
use \App\OrderVirtuemart;
use \App\OrderUserInfos;

class PlaceOrderController extends Controller
{
    public function index(Request $request)
    {
        $data = array();
        $uid = (int)$request->input('uid');
        
        $data['first_name'] = $request->input('first_name');
        $data['middle_name'] = $request->input('middle_name');
        $data['last_name'] = $request->input('last_name');
        //$data['name'] = $data['first_name'] . ' ' . $data['middle_name'] . ' ' . $data['last_name'];
        $data['virtuemart_country_id'] = (int)$request->input('countryid');
        $data['virtuemart_state_id'] = (int)$request->input('stateid');
        $data['zip'] = $request->input('zip');
        $data['city'] = $request->input('city');
        $data['address_1'] = $request->input('address_1');
        $data['address_2'] = $request->input('address_2');
        $data['phone_1'] = $request->input('phone1');
        $data['phone_2'] = $request->input('phone2');
        
        $ship_type = $request->input('ship_type');
        $payment_type = (int)$request->input('payment_type');
        $info = $request->input('info');
        
        $order = Orders::where('user_id', $uid)->first();
        
       // $arr = array();
        //$i = 0;
        
        
          //  $arr[$i]['virtuemart_product_id'] = $product->virtuemart_product_id;
          //  $arr[$i]['quantity'] = $product->pivot->quantity;
        
        
        //$ovf = OrderVirtuemart::where('virtuemart_user_id',$uid)->count();
        
        //if($ovf==0) {
            $ov = new OrderVirtuemart;
            $ov->virtuemart_user_id = $uid;
            $ov->ip_address  = $this->getip();
            $ov->virtuemart_paymentmethod_id = $payment_type;
            $ov->order_number = 1;
            $ov->customer_note = $info;
            $ov->save();
            
        //}
        //else {
        //    $ov = OrderVirtuemart::where('virtuemart_user_id',$uid)->first();
        //}
        
        $user = DB::table('bxtnj_users')->where('bxtnj_users.id','=',$uid)->first();
        $data['email'] = $user->email;
        
        $userinfos = new OrderUserInfos($data);
        
        $ov->userinfos()->save($userinfos);
        
        foreach ($order->products as $product) {
            
            $pivotdata = array('product_quantity'=>$product->pivot->quantity,
                               'order_item_sku' => 'артикул',
                               'order_item_name' => 'название',
                               'product_item_price' => '3000.00');
            
            $ov->products()->attach([$product->virtuemart_product_id,], $pivotdata);
        }
        
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