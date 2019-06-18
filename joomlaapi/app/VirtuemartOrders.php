<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class VirtuemartOrders extends Model {
    
    protected $table = 'bxtnj_virtuemart_orders';
    
    protected $primaryKey = 'virtuemart_order_id';

    protected $fillable = [];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    // Relationships
    
    public function products()
    {
        return $this->belongsToMany('App\VirtuemartProducts');
    }
}
