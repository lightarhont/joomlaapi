<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use \App\Orders;

class BasketAddController extends Controller
{
    
    public function index(Request $request)
    {
        $productid = (int)$request->input('id');
        $uid = (int)$request->input('uid');
        $quantity = (int)$request->input('quantity');
        
        $order = Orders::where('user_id', $uid)->count();
        if($order == 0):
            $order = new Orders;
            $order->user_id = $uid;
            $order->save(['timestamps' => false ]);
        else:
            $order = Orders::where('user_id', $uid)->first();
            
            
            foreach ($order->products as $product) {
                if($product->pivot->product_id == $productid){
                    $quantity += $product->pivot->quantity;
                    $product->pivot->delete();
                }
            }
            
        endif;
        
        $order->products()->attach([$productid,], array('quantity'=>$quantity));
        
        return $this->result($productid);
    }
    
}