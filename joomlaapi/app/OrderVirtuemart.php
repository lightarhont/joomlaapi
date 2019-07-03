<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderVirtuemart extends Model {
    public $timestamps = false;
    protected $table = 'bxtnj_virtuemart_orders';
    
    protected $primaryKey = 'virtuemart_order_id';
    
    public function products()
    {
        return $this->belongsToMany('App\VirtuemartProducts', 'bxtnj_virtuemart_order_items', 'virtuemart_order_id', 'virtuemart_product_id')->withPivot('product_quantity');
    }
    
    public function userinfos()
    {
        return $this->hasOne('App\OrderUserInfos', 'virtuemart_order_id', 'virtuemart_order_id');
    }
    
    public function history()
    {
        return $this->hasOne('App\OrderHistory', 'virtuemart_order_id', 'virtuemart_order_id');
    }
}