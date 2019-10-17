<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use \App\Orders;
use \App\OrderVirtuemart;
use \App\OrderUserInfos;
use \App\OrderHistory;
use \App\VirtuemartProducts;
use \App\YandexKassaToken;

class PlaceOrderController extends Controller
{
    
    protected function getparentproduct($product){
        if($product->product_parent_id == 0) {
            return $product;
        } else {
            return VirtuemartProducts::where('virtuemart_product_id', $product->product_parent_id)->first();
        }
    }
    
    public function index(Request $request)
    {
        $data = array();
        $uid = (int)$request->input('uid');
        
        $data['first_name'] = $request->input('first_name');
        $data['last_name'] = $request->input('last_name');
        //$data['name'] = $data['first_name'] . ' ' . $data['middle_name'] . ' ' . $data['last_name'];
        $data['zip'] = $request->input('zip');
        $data['address_type_name'] = $request->input('address');
        $data['phone_1'] = $request->input('phone1');
        
        $ship_type = $request->input('ship_type');
        $payment_type = (int)$request->input('payment_type');
        $info = $request->input('info');
        
        $first_name_delivery = $request->input('first_name_delivery', '');
        $last_name_delivery = $request->input('last_name_delivery', '');
        $phone_delivery = $request->input('phone_delivery', '');
        $address_delivery = $request->input('address_delivery', '');
        $payment_token = $request->input('payment_token', '');
        
        if($last_name_delivery != '') {
            $data['last_name'] = $last_name_delivery;
        }
        if($last_name_delivery != '') {
            $data['phone_1'] = $phone_delivery;
        }
        if($address_delivery != '') {
            $data['address_type_name'] = $address_delivery;
        }
        
        $order = Orders::where('user_id', $uid)->first();
        
        $totalprice = 0;
        foreach($order->products as $product){
            $productdata = $this->getparentproduct($product);
            $totalprice += $productdata->price->product_price;
        }
        
        $date = date('Y-m-d H:i:s');
        
        //$ovlastget = OrderVirtuemart::orderBy('virtuemart_order_id', 'desc')->get();
	
	$ovlastgetcount = OrderVirtuemart::count();

	if($ovlastgetcount != 0){
		$ovlastget = OrderVirtuemart::orderBy('virtuemart_order_id', 'desc')->get();
		$ovlast = (string)($ovlastget[0]->virtuemart_order_id+1).time();
	} else {
		$ovlast = (string)"1".time();
	}
        
        $kassapaymentid = 5; 
        if($payment_type == $kassapaymentid){
            $order_status = 'P';
        } else {
            $order_status = 'U';
        }
        
        $ov = new OrderVirtuemart;
        $ov->virtuemart_user_id = $uid;
        $ov->ip_address  = $this->getip();
        $ov->virtuemart_paymentmethod_id = $payment_type;
        
        $ov->order_number = $ovlast;
        $ov->order_pass = $this->RandomString();
        $ov->customer_number = $this->RandomString();
        
        $ov->customer_note = $info;
        $ov->order_total = $totalprice;
        $ov->order_salesPrice = $totalprice;
        $ov->order_subtotal = $totalprice;
        $ov->order_tax = '0.0000';
        $ov->order_shipment = '0.00';
        $ov->order_shipment_tax = '0.0000';
        $ov->order_payment = '0.00';
        $ov->order_payment_tax = '0.0000';
        $ov->order_currency = 131;
        $ov->order_status = $order_status;
        $ov->user_currency_id = 131;
        $ov->virtuemart_shipmentmethod_id = $ship_type;
        $ov->order_language ='ru-RU';
        $ov->created_by = $uid;
        $ov->modified_by = $uid;
        $ov->created_on = $date;
        $ov->modified_on = $date;
        $ov->save();
            
        $user = DB::table('bxtnj_users')->where('bxtnj_users.id','=',$uid)->first();
        $data['email'] = $user->email;
        $data['virtuemart_user_id'] = $uid;
        if($first_name_delivery == '') {
            $data['address_type'] = 'BT';
        } else {
            $data['address_type'] = 'ST';
            $data['first_name'] = $first_name_delivery;
        }
        $data['created_by'] = $uid;
        $data['created_on'] = $date;
        
        $userinfos = new OrderUserInfos($data);
        
        $ov->userinfos()->save($userinfos);
        
        $ohdata = array('order_status_code'=>'U',
                        'created_by'=>$uid,
                        'modified_by'=>$uid,
                        'created_on'=>$date,
                        'modified_on'=>$date,
                        'published'=>1);
        
        $oh = new OrderHistory($ohdata);
        $ov->history()->save($oh);
        
        foreach ($order->products as $product) {
            $productdata = $this->getparentproduct($product);
            $price = $productdata->price->product_price;
            $pivotdata = array('product_quantity'=>$product->pivot->quantity,
                               'order_item_sku' => $product->ru->product_name,
                               'order_item_name' => $product->ru->product_name,
                               'product_item_price' => $price,
                               'product_subtotal_with_tax'=> $price,
                               'product_final_price'=> $price,
                               'product_discountedPriceWithoutTax'=> $price,
                               'product_basePriceWithTax'=> $price,
                               'created_by' => $uid,
                               'modified_by' => $uid,
                               'created_on' => $date,
                               'modified_on' => $date,
                               'order_status' => 'U',
                               'product_attribute' => $product->pivot->params
                               );
            
            $params = json_decode($product->pivot->params);
            
            if(is_object($params)):
                $key = key(get_object_vars($params));
            else:
                $key = $product->virtuemart_product_id;
            endif;
            
            $ov->products()->attach([$key,], $pivotdata);
        }
        
        $result = array(
            'id'=>$ov->virtuemart_order_id,
            'number'=>$ov->order_number,
            'order_total'=>$ov->order_total,
            'date'=>$ov->created_on
        );
        
        DB::table('orderproduct')->where('order_id','=', $order->id)->delete();
        
        
        if($payment_type == $kassapaymentid){
            $result['order_status'] = 'pending'; 
            $result['yandexkassa_token'] = $this->setkassatoken($ov->virtuemart_order_id);
        }
        
        return $this->result($result);
        
    }
    
    public function setkassatoken($orderid){
        $token = sha1(mt_rand(1, 90000) . 'SALT');
        $expires_in = time()+60*60;
        $yk = new YandexKassaToken;
        $yk->access_token = $token;
        $yk->order_id = $orderid;
        $yk->expires_in = $expires_in;
        $yk->save();
        return $token;
    }
    
    public function RandomString($length = 10)
    {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
    }

}
