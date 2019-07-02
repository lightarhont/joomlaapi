<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BannersController extends Controller
{
    public function index(Request $request)
    {
        $banners = DB::table('bxtnj_banners')->get();
        
        $arr = array();
        $i = 0;
        foreach ($banners as $banner){
            $arr[$i]['id'] = $banner->id;
            $arr[$i]['dest_url'] = $banner->clickurl;
            $arr[$i]['params'] = $banner->params;
            $i = $i + 1;
        }
        
        return $this->result($arr);
    }
}