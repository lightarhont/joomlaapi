<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserInfoController extends Controller
{
    public function index(Request $request)
    {
        $uid = (int)$request->input('uid');
        
        $user = DB::table('bxtnj_users')
        ->leftJoin('bxtnj_virtuemart_userinfos', 'bxtnj_virtuemart_userinfos.virtuemart_user_id', '=', 'bxtnj_users.id')
        ->where('bxtnj_users.id','=',$uid)
        ->first();
        
        $userinfo = array();
        $userinfo['id'] = $user->id;
        $userinfo['email'] = $user->email;
        $userinfo['first_name'] = $user->first_name;
        $userinfo['middle_name'] = $user->middle_name;
        $userinfo['last_name '] = $user->last_name;
        
        if($user->virtuemart_country_id != 0) {
            $country = DB::table('bxtnj_virtuemart_countries')->where('virtuemart_country_id', '=', $user->virtuemart_country_id)->first();
            $userinfo['country'] = $country->country_name;
        }
        
        if($user->virtuemart_state_id != 0) {
            $country = DB::table('bxtnj_virtuemart_states')->where('virtuemart_state_id', '=', $user->virtuemart_state_id)->first();
            $userinfo['state'] = $country->country_name;
        }
        
        $userinfo['city'] = $user->city;
        $userinfo['zip'] = $user->zip;
        $userinfo['address_1'] = $user->address_1;
        $userinfo['address_2'] = $user->address_2;
        $userinfo['phone1'] = $user->phone_1;
        $userinfo['phone2'] = $user->phone_2;
        
        return $this->result($userinfo);
    }
}