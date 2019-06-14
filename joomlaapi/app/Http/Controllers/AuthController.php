<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\PasswordHash;

class AuthController extends Controller
{

    public function index(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $error = false;
        $user = DB::table('bxtnj_users')->where('email', '=', $email)->first();
        if($user != NULL):
            $ph = new PasswordHash();
            $ph->PasswordHash(10, true);
            if($ph->CheckPassword($password, $user->password)):
                return $this->sendtocken($user);
            else:
                $error = 2;
            endif;
        else:
            $error = 1;
        endif;
        
        return $this->errors($error);
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
            return $this->errors(3);
        endif;
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
    
    
    protected function errors($error){
        switch ($error) {
            case 1:
                $errormsg = 'Неверный логин';
                break;
            case 2:
                $errormsg = 'Неверный пароль';
                break;
            case 3:
                $errormsg = 'Ошибка базы при создания токена';
                break;
            }
        return $this->result(array('error'=>array('code'=>$error, 'message'=>$errormsg)));
    }
}