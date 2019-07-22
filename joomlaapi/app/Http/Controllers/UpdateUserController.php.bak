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
        $data1['username'] = $request->input('username');
        
        $data2['first_name'] = $request->input('first_name');
        $data2['last_name'] = $request->input('last_name');
        $data2['phone_1'] = (int)$request->input('phone');
        
        $data2['address_type_name'] = $request->input('address');
        $data2['zip'] = $request->input('zip');
        
        VirtuemartUser::where('id', $uid)->update($data1);
        
        //OrderUserInfos::where('virtuemart_user_id', $uid)->update($data2);
        
        $date = date('Y-m-d H:i:s');
        
        $f = DB::table('bxtnj_virtuemart_userinfos')->where('virtuemart_user_id','=', $uid)->count();
        if($f == 0){
            
            $data2['virtuemart_user_id'] = $uid;
            $data2['created_by'] = $uid;
            $data2['created_on'] = $date;
            $data2['address_type'] = 'BT';
            
            DB::table('bxtnj_virtuemart_userinfos')->insert($data2);
        } else {
            
            $data2['modified_on'] = $date;
            $data2['modified_by'] = $uid;
            
            DB::table('bxtnj_virtuemart_userinfos')->where('virtuemart_user_id','=', $uid)->update($data2);
        }
        
        return $this->result(array_merge($data1, $data2));
    }
}