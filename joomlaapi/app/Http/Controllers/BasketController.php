<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BasketController extends Controller
{

    public function index(Request $request)
    {        
        $uid = $request->input('uid');
        
        $results = DB::select("
select `bxtnj_virtuemart_products`.`product_sku` as `productname`
from `bxtnj_virtuemart_orders`
left join `bxtnj_virtuemart_order_items` on `bxtnj_virtuemart_orders`.`virtuemart_order_id` = `bxtnj_virtuemart_order_items`.`virtuemart_order_id`
left join `bxtnj_virtuemart_products` on `bxtnj_virtuemart_order_items`.`virtuemart_product_id` = `bxtnj_virtuemart_products`.`virtuemart_product_id`
where `bxtnj_virtuemart_orders`.`virtuemart_user_id` = ".$uid
);
        
        return var_dump($results);
    }
    
    

}