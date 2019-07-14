<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class VirtuemartOrderItems extends Model {
    
    protected $table = 'bxtnj_virtuemart_order_items';
    
    protected $primaryKey = 'virtuemart_order_item_id';

    protected $fillable = ['product_quantity', 'order_item_sku', 'order_item_name', 'product_item_price',
                           'created_by', 'created_on', 'modifed_by', 'modifed_on', 'order_status',
                           'product_subtotal_with_tax', 'product_final_price', 'product_discountedPriceWithoutTax',
                           'product_basePriceWithTax', 'order_status', 'product_attribute'];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    // Relationships

}
