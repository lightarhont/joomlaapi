<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use \App\VirtuemartProducts;

class NewItemsController extends Controller
{
    public function index(Request $request)
    {
        $offset = (int)$request->input('offset');
        $limit = (int)$request->input('limit');
        
        $products = VirtuemartProducts::orderBy('virtuemart_product_id', 'desc')->offset($offset)->limit($limit)->get();
        
        
        return $this->iterproducts($products);
    }
}