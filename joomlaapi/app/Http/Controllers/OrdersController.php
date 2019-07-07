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
        
        $ov = OrderVirtuemart::where('virtuemart_user_id',$uid)->first();
    }
}