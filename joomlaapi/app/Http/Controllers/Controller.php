<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use \App\VirtuemartProducts;

class Controller extends BaseController
{
    
    //Нужно изменить secretkey из configuration.php Joomla
    public $secret = '6vi8mD9220dZm9gg';
    
    public function result($array){
        return response()->json($array);
    }
    
    public function getSalt($encryption = 'md5-hex', $seed = '', $plaintext = '')
	{
		// Encrypt the password.
		switch ($encryption)
		{
			case 'crypt':
			case 'crypt-des':
				if ($seed)
				{
					return substr(preg_replace('|^{crypt}|i', '', $seed), 0, 2);
				}
				else
				{
					return substr(md5(mt_rand()), 0, 2);
				}
				break;

			case 'crypt-md5':
				if ($seed)
				{
					return substr(preg_replace('|^{crypt}|i', '', $seed), 0, 12);
				}
				else
				{
					return '$1$' . substr(md5(mt_rand()), 0, 8) . '$';
				}
				break;

			case 'crypt-blowfish':
				if ($seed)
				{
					return substr(preg_replace('|^{crypt}|i', '', $seed), 0, 16);
				}
				else
				{
					return '$2$' . substr(md5(mt_rand()), 0, 12) . '$';
				}
				break;

			case 'ssha':
				if ($seed)
				{
					return substr(preg_replace('|^{SSHA}|', '', $seed), -20);
				}
				else
				{
					return mhash_keygen_s2k(MHASH_SHA1, $plaintext, substr(pack('h*', md5(mt_rand())), 0, 8), 4);
				}
				break;

			case 'smd5':
				if ($seed)
				{
					return substr(preg_replace('|^{SMD5}|', '', $seed), -16);
				}
				else
				{
					return mhash_keygen_s2k(MHASH_MD5, $plaintext, substr(pack('h*', md5(mt_rand())), 0, 8), 4);
				}
				break;

			case 'aprmd5': /* 64 characters that are valid for APRMD5 passwords. */
				$APRMD5 = './0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';

				if ($seed)
				{
					return substr(preg_replace('/^\$apr1\$(.{8}).*/', '\\1', $seed), 0, 8);
				}
				else
				{
					$salt = '';
					for ($i = 0; $i < 8; $i++)
					{
						$salt .= $APRMD5{rand(0, 63)};
					}
					return $salt;
				}
				break;

			default:
				$salt = '';
				if ($seed)
				{
					$salt = $seed;
				}
				return $salt;
				break;
		}
	}
    
    public function setiterproducts($products){
        $arr = array();
        foreach($products as $product){
            $arr[] = $product->virtuemart_product_id;
        }
        
        return $this->iterproducts(VirtuemartProducts::whereIn('virtuemart_product_id', $arr)->get());
    }
    
    
    public function iterproducts($products){
        
        $arr = array();
        $i = 0;
        foreach ($products as $product) {
            
            $arr[$i]['virtuemart_product_id'] = $product->virtuemart_product_id;
            $arr[$i]['name'] = $product->ru->product_name;
            $arrmedia = array();
            
            foreach ($product->medias as $media){
                $arrmedia[] = $media->file_url;
            }
            
            $arr[$i]['images'] = $arrmedia;
            
            $arr[$i]['brand'] = $product->manufacturer->ru->mf_name;
            
            if($product->price()->first() != NULL) {
                $arr[$i]['price'] = $product->price->product_price;
            }
            
            if($product->fiels()->first() != NULL) {
                $arr[$i]['params'] = json_decode($product->fiels->custom_param);
            }
            
            $i = $i + 1;
        }
        
        return $arr;
    }
    
    public function iterproductscart($order){
        
        $arr = array();
        $i = 0;
        foreach ($order->products as $product) {
            
            $arr[$i]['virtuemart_product_id'] = $product->virtuemart_product_id;
            $arr[$i]['name'] = $product->ru->product_name;
            $arrmedia = array();
            
            foreach ($product->medias as $media){
                $arrmedia[] = $media->file_url;
            }
            
            $arr[$i]['images'] = $arrmedia;
            
            $arr[$i]['brand'] = $product->manufacturer->ru->mf_name;
            
            $arr[$i]['params'] = json_decode($product->pivot->params);
            $arr[$i]['quantity'] = $product->pivot->quantity;
            
            if($product->price()->first() != NULL) {
                $arr[$i]['price'] = $product->price->product_price;
            }
            
            $parent = $product->product_parent_id;
            
            if($parent != 0) {
                
                $parentobj = VirtuemartProducts::where('virtuemart_product_id', $parent)->first();
                
                $arr[$i]['parent']['id'] = $product->product_parent_id;
                
                $arr[$i]['parent']['name'] = $parentobj->ru->product_name;
                
                $arrmedia = array();
                foreach ($parentobj->medias as $media){
                    $arrmedia[] = $media->file_url;
                }
                $arr[$i]['parent']['images'] = $arrmedia;
                
                if($parentobj->price()->first() != NULL) {
                    $arr[$i]['parent']['price'] = $parentobj->price->product_price;
                }
                
                $arr[$i]['parent']['brand'] = $parentobj->manufacturer->ru->mf_name;
                
            }
            
            $i = $i + 1;
        }
        
        return $arr;
    }
    
    public function getip(){
                if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

return $ip;
    }
}
