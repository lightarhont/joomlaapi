<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use \App\Orders;

class BasketRemoveItemController extends Controller
{

    public function index(Request $request)
    {
        $uid = (int)$request->input('uid');
        $item_id = (int)$request->input('item_id');
        
        $order = Orders::where('user_id', $uid)->count();
        if($order == 0):
            $order = new Orders;
            $order->user_id = $uid;
            $order->save(['timestamps' => false ]);
        else:
            $order = Orders::where('user_id', $uid)->first();
        endif;
        
        $order = Orders::where('user_id', $uid)->first();
        
        
        foreach ($order->products as $product) {
            if($product->pivot->product_id == $item_id){
                    $product->pivot->delete();
            }
        }
        
        $order = Orders::where('user_id', $uid)->first();
        
        return $this->result($this->iterproductscart($order));
    }
}