<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use \App\VirtuemartProductsRu;
use \App\VirtuemartProducts;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $products = VirtuemartProductsRu::where('product_name', 'like', '%'.$search.'%')->get();
        
        return $this->result($this->setiterproducts($products));
    }
}