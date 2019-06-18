<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class VirtuemartProducts extends Model {
    
    protected $table = 'bxtnj_virtuemart_products';
    
    protected $primaryKey = 'virtuemart_product_id';

    protected $fillable = [];

    protected $dates = [];

    public static $rules = [
        // Validation rules
    ];

    // Relationships

}
