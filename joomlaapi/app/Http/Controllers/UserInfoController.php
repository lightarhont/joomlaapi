<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\VirtuemartUser;

class UserInfoController extends Controller
{
    public function index(Request $request)
    {
        $uid = (int)$request->input('uid');
        
        $u = VirtuemartUser::where('id', $uid)->first();
        
        $f = DB::table('bxtnj_virtuemart_userinfos')->where('virtuemart_user_id','=', $uid)->count();
        
        $data = array();
        
        $data['id'] = $uid;
        $data['username'] = $u->username;
        $data['name'] = $u->name;
        $data['email'] = $u->email;
        
        if($f == 0){
            $data['profile'] = false;
        } else {
            //$profile = array();
            $p = DB::table('bxtnj_virtuemart_userinfos')->where('virtuemart_user_id','=', $uid)->first();
            $profile = $p;
            $data['profile'] = $profile;
        }
        
        
        return $this->result($data);
    }
}