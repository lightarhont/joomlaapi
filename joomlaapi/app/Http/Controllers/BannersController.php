<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BannersController extends Controller
{
    public function index(Request $request)
    {
        $banners = DB::table('bxtnj_modules')->where('id', 	665)->first();
        
        /*
        $arr = array();
        $i = 0;
        foreach ($banners as $banner){
            $arr[$i]['id'] = $banner->id;
            $arr[$i]['dest_url'] = $banner->clickurl;
            $arr[$i]['params'] = json_decode($banner->params);
            $i = $i + 1;
        }
        */
        
        $data = json_decode(json_decode($banners->params)->image_show_data);
        
        return $this->result($data);
    }
}