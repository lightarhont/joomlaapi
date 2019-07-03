<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderUserInfos extends Model {
    
    public $timestamps = false;
    protected $table = 'bxtnj_virtuemart_order_userinfos';
    
    protected $primaryKey = 'virtuemart_order_userinfo_id';
    
}