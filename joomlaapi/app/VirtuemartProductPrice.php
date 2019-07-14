<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class VirtuemartProductPrice extends Model {
    
    protected $table = 'bxtnj_virtuemart_product_prices';
    
    protected $primaryKey = 'virtuemart_product_price_id';
    
    public function product()
    {
        return $this->hasOne('App\VirtuemartProducts', 'virtuemart_product_id', 'virtuemart_product_id');
    }

}