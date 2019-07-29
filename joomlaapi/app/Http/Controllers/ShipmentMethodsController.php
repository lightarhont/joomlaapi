<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\ShipmentMethods;

class ShipmentMethodsController extends Controller
{

    public function index(Request $request)
    {
        $sms = ShipmentMethods::where('published', 1)->get();
        
        $arr = array();
        $i = 0;
        foreach($sms as $sm){
            $arr[$i]['ru'] = $sm->ru;
            $arr[$i]['shipment_params'] = $sm->shipment_params;
            $i = $i+1;
        }
        return $arr;
    }
    
}