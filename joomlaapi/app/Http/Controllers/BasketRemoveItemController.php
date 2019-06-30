<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

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
        
        foreach ($order->products as $product) {
            if($product->pivot->product_id == $productid){
                    $product->pivot->delete();
            }
        }
    }
}