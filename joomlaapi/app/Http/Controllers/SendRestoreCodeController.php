<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SendRestoreCodeController extends Controller
{

    public function index(Request $request)
    {
        $uid = $request->input('uid');
        $code = $request->input('code');
        $user = DB::table('bxtnj_users')->where('id', '=', $uid)->first();
        if($user != NULL):
            $salt = $this->getSalt('crypt-md5');
            $hashedToken = md5($code.$salt).':'.$salt;
            if($user->activation == $hashedToken):
                return $this->result(array('success'=>true));
            else:
                return $this->errors(2);
            endif;
        else:
            return $this->errors(1);
        endif;
        
    }
    
    protected function errors($error){
        switch ($error) {
            case 1:
                $errormsg = 'Пользователь с таким именем пользоателя не найден!';
                break;
            case 2:
                $errormsg = 'Код не подходит';
                break;
        }    
        return $this->result(array('error'=>array('code'=>$error, 'message'=>$errormsg)));
    
    }
}