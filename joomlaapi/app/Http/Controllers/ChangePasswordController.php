<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\PasswordHash;

class ChangePasswordController extends Controller
{

    public function index(Request $request)
    {
        $uid = $request->input('uid');
        $password = $request->input('password');
        
        $ph = new PasswordHash();
        $ph->PasswordHash(10, true);
        $hp = $ph->HashPassword($password);
        
        $user = DB::table('bxtnj_users')->where('id', $uid)->first();
        if($user != NULL):
            DB::table('bxtnj_users')->where('id', $uid)->update(['password' => $hp]);
        
            return $this->sendtocken($user);
            
        else:
            $this->errors(1);
        endif;
    
    }
    
    protected function sendtocken($user){
        $token = sha1(mt_rand(1, 90000) . 'SALT');
        $refresh_token = 1;
        $expires_in = time()+60*60;
        
        $insert = array('access_token'=>$token,'refresh_token'=>$refresh_token,'expires_in'=>$expires_in);
        
        if($this->transaction($insert)):
            $insert['id'] = $user->id;
            return $this->result($insert);
        else:
            return $this->errors(2);
        endif;
    }
    
    protected function errors($error){
        switch ($error) {
            case 1:
                $errormsg = 'Пользователь не найден';
                break;
            case 2:
                $errormsg = 'Ошибка базы при создания токена';
                break;
            }
        return $this->result(array('error'=>array('code'=>$error, 'message'=>$errormsg)));
    }
    
    protected function transaction($insert) {
            DB::beginTransaction();
            try
            {
                $result = DB::table('api_user_tokens')->insertGetId($insert);
                DB::commit();
            }

            catch (\Exception $e)
            {
                DB::rollback();
                return false;
            }
            return true;
    }
}