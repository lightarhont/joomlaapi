<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderShipped;

class RemindPassController extends Controller
{
    
    public function index(Request $request)
    {
        $email = $request->input('email');
        $findindb = $this->findindb($email);
        if($findindb != false):
            $t = md5($this->secret. $this->genRandomPassword());
            $this->savetouser($t, $findindb);
            $this->sendemail($email, $t);
            return $this->result(array('id'=>$findindb));
        else:
            $error = 1;
            $errormsg = 'Нет такого пользователя!';
            $errorarray = array('error'=>array('code'=>$error, 'message'=>$errormsg));
            return $this->result($errorarray);
        endif;
    }
    
    protected function savetouser($t, $findindb){
        $salt = $this->getSalt('crypt-md5');
        $hashedToken = md5($t.$salt).':'.$salt;
        DB::table('bxtnj_users')->where('id', $findindb)->update(['activation' => $hashedToken]);
    }
    
    protected function sendemail($email, $t){
        Mail::to($email)->send(new OrderShipped($t));
    }
    
    protected function findindb($email)
    {
        $user = DB::table('bxtnj_users')->where('email', '=', $email)->first();
        if($user != NULL):
            return $user->id; 
        else:
            return false;
        endif;
    }
    
    public function genRandomPassword($length = 8)
	{
		$salt = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$base = strlen($salt);
		$makepass = '';

		/*
		 * Start with a cryptographic strength random string, then convert it to
		 * a string with the numeric base of the salt.
		 * Shift the base conversion on each character so the character
		 * distribution is even, and randomize the start shift so it's not
		 * predictable.
		 */
		$random = $this->genRandomBytes($length + 1);
		$shift = ord($random[0]);
		for ($i = 1; $i <= $length; ++$i)
		{
			$makepass .= $salt[($shift + ord($random[$i])) % $base];
			$shift += ord($random[$i]);
		}

		return $makepass;
	}
    
    public function genRandomBytes($length = 16)
	{
		$sslStr = '';
		/*
		 * if a secure randomness generator exists and we don't
		 * have a buggy PHP version use it.
		 */
		if (function_exists('openssl_random_pseudo_bytes')
			&& (version_compare(PHP_VERSION, '5.3.4') >= 0 || IS_WIN))
		{
			$sslStr = openssl_random_pseudo_bytes($length, $strong);
			if ($strong)
			{
				return $sslStr;
			}
		}

		/*
		 * Collect any entropy available in the system along with a number
		 * of time measurements of operating system randomness.
		 */
		$bitsPerRound = 2;
		$maxTimeMicro = 400;
		$shaHashLength = 20;
		$randomStr = '';
		$total = $length;

		// Check if we can use /dev/urandom.
		$urandom = false;
		$handle = null;

		// This is PHP 5.3.3 and up
		if (function_exists('stream_set_read_buffer') && @is_readable('/dev/urandom'))
		{
			$handle = @fopen('/dev/urandom', 'rb');
			if ($handle)
			{
				$urandom = true;
			}
		}

		while ($length > strlen($randomStr))
		{
			$bytes = ($total > $shaHashLength)? $shaHashLength : $total;
			$total -= $bytes;
			/*
			 * Collect any entropy available from the PHP system and filesystem.
			 * If we have ssl data that isn't strong, we use it once.
			 */
			$entropy = rand() . uniqid(mt_rand(), true) . $sslStr;
			$entropy .= implode('', @fstat(fopen(__FILE__, 'r')));
			$entropy .= memory_get_usage();
			$sslStr = '';
			if ($urandom)
			{
				stream_set_read_buffer($handle, 0);
				$entropy .= @fread($handle, $bytes);
			}
			else
			{
				/*
				 * There is no external source of entropy so we repeat calls
				 * to mt_rand until we are assured there's real randomness in
				 * the result.
				 *
				 * Measure the time that the operations will take on average.
				 */
				$samples = 3;
				$duration = 0;
				for ($pass = 0; $pass < $samples; ++$pass)
				{
					$microStart = microtime(true) * 1000000;
					$hash = sha1(mt_rand(), true);
					for ($count = 0; $count < 50; ++$count)
					{
						$hash = sha1($hash, true);
					}
					$microEnd = microtime(true) * 1000000;
					$entropy .= $microStart . $microEnd;
					if ($microStart > $microEnd)
					{
						$microEnd += 1000000;
					}
					$duration += $microEnd - $microStart;
				}
				$duration = $duration / $samples;

				/*
				 * Based on the average time, determine the total rounds so that
				 * the total running time is bounded to a reasonable number.
				 */
				$rounds = (int) (($maxTimeMicro / $duration) * 50);

				/*
				 * Take additional measurements. On average we can expect
				 * at least $bitsPerRound bits of entropy from each measurement.
				 */
				$iter = $bytes * (int) ceil(8 / $bitsPerRound);
				for ($pass = 0; $pass < $iter; ++$pass)
				{
					$microStart = microtime(true);
					$hash = sha1(mt_rand(), true);
					for ($count = 0; $count < $rounds; ++$count)
					{
						$hash = sha1($hash, true);
					}
					$entropy .= $microStart . microtime(true);
				}
			}

			$randomStr .= sha1($entropy, true);
		}

		if ($urandom)
		{
			@fclose($handle);
		}

		return substr($randomStr, 0, $length);
	}
}