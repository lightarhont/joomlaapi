<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\PaymentMethods;

class PaymentMethodsController extends Controller
{

    public function index(Request $request)
    {
        $pm = PaymentMethods::get();
        return $pm;
    }
    
}