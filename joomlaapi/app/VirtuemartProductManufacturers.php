<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class VirtuemartProductManufacturers extends Model {
    
    protected $table = 'bxtnj_virtuemart_product_manufacturers';
    
    protected $primaryKey = 'id';
    
    public function ru()
    {
      return $this->hasOne('App\VirtuemartProductManufacturersRu', 'virtuemart_manufacturer_id', 'virtuemart_manufacturer_id');
    }

}