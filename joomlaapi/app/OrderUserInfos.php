<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderUserInfos extends Model {
    
    public $timestamps = false;
    protected $table = 'bxtnj_virtuemart_order_userinfos';
    
    protected $primaryKey = 'virtuemart_order_userinfo_id';
    
    protected $fillable = ['first_name', 'middle_name', 'last_name', 'zip', 'city', 'address_1', 'address_2',
                           'phone_1', 'email', 'virtuemart_user_id', 'address_type', 'address_type_name'];
    
}