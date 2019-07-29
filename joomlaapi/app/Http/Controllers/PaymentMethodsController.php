<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\PaymentMethods;

class PaymentMethodsController extends Controller
{

    public function index(Request $request)
    {
        $pms = PaymentMethods::where('published', 1)->get();
        
        $arr = array();
        $i = 0;
        foreach($pms as $pm){
            $arr[$i]['ru'] = $pm->ru;
            $arr[$i]['payment_params'] = $pm->payment_params;
            $i = $i+1;
        }
        return $arr;
    }
    
}