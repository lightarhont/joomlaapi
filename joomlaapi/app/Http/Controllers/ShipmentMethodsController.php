<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\ShipmentMethods;

class ShipmentMethodsController extends Controller
{

    public function index(Request $request)
    {
        $sm = ShipmentMethods::get();
        return $sm;
    }
    
}