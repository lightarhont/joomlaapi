<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\PasswordHash;

class RegisterController extends Controller
{

    public function index(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        
        $findindb = $this->findindb($name, $email, $password);
        if($findindb == 0):
            $date = date("Y-m-d H:i:s");
            $ph = new PasswordHash();
            $ph->PasswordHash(10, true);
            $hp = $ph->HashPassword($password);
            $insert = array('name'=>$name,
                                'username'=>$email,
                                'email'=>$email,
                                'password'=>$hp,
                                'usertype'=>'',
                                'block'=>0,
                                'sendEmail'=>0,
                                'registerDate'=>$date,
                                'lastvisitDate'=>$date,
                                'activation'=>0,
                                'params'=>'{}',
                                'lastResetTime'=>0,
                                'resetCount'=>0
                            );
            
            $tr_result = $this->transaction($insert);
            if($tr_result != false):
                return $this->result(array('id'=>$tr_result));
            else:
                return $this->errors(3);
            endif;
        else:
            return $this->errors($findindb);
        endif;
    }
    
    protected function findindb($name, $email, $password){
        $user = DB::table('bxtnj_users')->where('email', '=', $email)->first();
        if($user == NULL):
            $user = DB::table('bxtnj_users')->where('name', '=', $name)->first();
            if($user == NULL):
                return 0;
            else:
                return 2;
            endif;
        else:
            return 1;
        endif;
    }
    
    protected function result($array){
        return response()->json(json_encode($array));
    }
    
    protected function errors($error){
        switch ($error) {
            case 1:
                $errormsg = 'Пользователь с таким email уже есть';
                break;
            case 2:
                $errormsg = 'Пользователь с таким именем уже есть';
                break;
            case 3:
                $errormsg = 'Ошибка базы при создания пользоателя';
                break;
            }
        return $this->result(array('error'=>array('code'=>$error, 'message'=>$errormsg)));
    }
    
    protected function transaction($insert) {
            DB::beginTransaction();
            try
            {
                $result = DB::table('bxtnj_users')->insertGetId($insert);
                DB::commit();
            }

            catch (\Exception $e)
            {
                DB::rollback();
                return false;
            }
            return $result;
    }
}