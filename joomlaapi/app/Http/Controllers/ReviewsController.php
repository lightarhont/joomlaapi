<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use \App\VirtuemartReviews;

class ReviewsController extends Controller
{
    
    public function index(Request $request)
    {
        $productid = (int)$request->input('id');
        
        $vrs = VirtuemartReviews::where('virtuemart_product_id', $productid)->where('published', 1)->get();
        
        
        $arr = array();
        $i = 0;
        foreach($vrs as $vr):
        
            $arr[$i]['product'] = $vr->product->ru->product_name;
            $arr[$i]['name'] = $vr->user->name;
            $arr[$i]['comment'] = $vr->comment;
            $arr[$i]['rating'] = $vr->review_rating;
            $arr[$i]['created'] = $vr->created_on;
            
            $i = $i + 1;
        
        endforeach;
        
        return $arr;
    }
}