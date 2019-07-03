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
        
        return $this->result($this->iterproducts($order->products));
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