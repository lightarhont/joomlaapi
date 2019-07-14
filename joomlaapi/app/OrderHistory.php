<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model {
    
    public $timestamps = false;
    protected $table = 'bxtnj_virtuemart_order_histories';
    
    protected $primaryKey = 'virtuemart_order_history_id';
    
    protected $fillable = ['order_status_code', 'created_on', 'modified_on', 'created_by', 'modified_by', 'published'];
    
    public function order()
    {
        return $this->hasOne('App\OrderVirtuemart', 'virtuemart_order_id', 'virtuemart_order_id');
    }
}