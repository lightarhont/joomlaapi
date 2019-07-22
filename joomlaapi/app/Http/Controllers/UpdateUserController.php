<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\VirtuemartUser;
use App\OrderUserInfos;

class UpdateUserController extends Controller
{
    public function index(Request $request)
    {
        $data1 = array();
        $uid = (int)$request->input('uid');
        $data1['name'] = $request->input('name');
        
        $data2['last_name'] = $request->input('last_name');
        $data2['phone'] = $request->input('phone');
        $data2['city'] = $request->input('city');
        $data2['street'] = $request->input('street'); 
        $data2['house'] = $request->input('house');
        $data2['flat'] = $request->input('flat');
        $data2['post_index'] = $request->input('post_index');
        
        VirtuemartUser::where('id', $uid)->update($data1);
        
        //OrderUserInfos::where('virtuemart_user_id', $uid)->update($data2);
        
        $date = date('Y-m-d H:i:s');
        
        $f = DB::table('userprofile')->where('user_id','=', $uid)->count();
        if($f == 0){
            $data2['user_id'] = $uid;
            DB::table('userprofile')->insert($data2);
        } else {
            DB::table('userprofile')->where('user_id','=', $uid)->update($data2);
        }
        
        return $this->result(array_merge($data1, $data2));
    }
}