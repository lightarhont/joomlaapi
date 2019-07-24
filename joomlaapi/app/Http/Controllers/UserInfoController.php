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
        
        $f = DB::table('userprofile')->where('user_id','=', $uid)->count();
        
        $data = array();
        
        $data['id'] = $uid;
        $data['username'] = $u->username;
        $data['name'] = $u->name;
        $data['email'] = $u->email;
        
        if($f == 0){
            $data['profile'] = false;
        } else {
            //$profile = array();
            $p = DB::table('userprofile')->where('user_id','=', $uid)->first();
            $data['last_name'] = $p->last_name;
            $data['phone'] = $p->phone;
            $data['city'] = $p->city;
            $data['street'] = $p->street;
            $data['house'] = $p->house;
            $data['flat'] = $p->flat;
            $data['post_index'] = $p->post_index;
        }
        
        
        return $this->result($data);
    }
}