<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class TestController extends Controller
{

    public function index()
    {
        
        return view('greeting', ['name' => 'James']);
    }
}