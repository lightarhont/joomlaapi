<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SubCategoriesController extends Controller
{
    public function index(Request $request)
    {
        $categoryid = (int)$request->input('categoryid');
        
        $categoryes = DB::table('bxtnj_virtuemart_category_categories')
        ->leftJoin('bxtnj_virtuemart_categories_ru_ru', 'bxtnj_virtuemart_categories_ru_ru.virtuemart_category_id', '=', 'bxtnj_virtuemart_category_categories.category_child_id')
        ->where('bxtnj_virtuemart_category_categories.category_parent_id', '=', $categoryid)->get();
        
        $arr = array();
        $i = 0;
        foreach($categoryes as $category) {
            $arr[$i]['id'] = $category->id;
            $arr[$i]['name'] = $category->category_name;
            $i = $i + 1;
        }
        
        return $this->result($arr);
    }
}