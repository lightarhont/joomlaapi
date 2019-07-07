<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UpdateUserController extends Controller
{
    public function index(Request $request)
    {
        $data = array();
        $uid = (int)$request->input('uid');
        $data['first_name'] = $request->input('first_name');
        $data['middle_name'] = $request->input('middle_name');
        $data['last_name'] = $request->input('last_name');
        $data['name'] = $data['first_name'] . ' ' . $data['middle_name'] . ' ' . $data['last_name'];
        $data['virtuemart_country_id'] = (int)$request->input('countryid');
        $data['virtuemart_state_id'] = (int)$request->input('stateid');
        $data['zip'] = $request->input('zip');
        $data['city'] = $request->input('city');
        $data['address_1'] = $request->input('address_1');
        $data['address_2'] = $request->input('address_2');
        $data['phone_1'] = $request->input('phone1');
        $data['phone_2'] = $request->input('phone2');
        
        DB::table('bxtnj_virtuemart_userinfos')->where('virtuemart_user_id','=', $uid)->update($data);
        
        return $this->result($data);
    }
}