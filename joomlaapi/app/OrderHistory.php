<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model {
    
    public $timestamps = false;
    protected $table = 'bxtnj_virtuemart_order_histories';
    
    protected $primaryKey = 'virtuemart_order_history_id';
    
}