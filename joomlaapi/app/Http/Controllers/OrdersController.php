<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use \App\OrderHistory;

class OrdersController extends Controller
{
    public function index(Request $request)
    {
        $uid = (int)$request->input('uid');
        
        $ovs = OrderHistory::where('created_by',$uid)->get();
        
        $data = array();
        $i = 0;
        foreach($ovs as $ov){
            if($ov->order != NULL){
                $data[$i]['id'] = $ov->virtuemart_order_id;
                $data[$i]['order_number'] = $ov->order->order_number;
                $data[$i]['order_total'] = $ov->order->order_total;
                $data[$i]['order_status_code'] = $ov->order_status_code;
                $data[$i]['created_on'] = $ov->created_on;
                $i=$i+1;
            }
        }
        
        return $data;
    }
}