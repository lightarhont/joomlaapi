<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class VirtuemartOrderItems extends Model {
    
    protected $table = 'bxtnj_virtuemart_order_items';
    
    protected $primaryKey = 'virtuemart_order_item_id';

    protected $fillable = [];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    // Relationships

}
