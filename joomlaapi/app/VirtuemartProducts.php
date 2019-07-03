<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class VirtuemartProducts extends Model {
    
    protected $table = 'bxtnj_virtuemart_products';
    
    protected $primaryKey = 'virtuemart_product_id';


    public function medias()
    {
        return $this->belongsToMany('App\VirtuemartMedias', 'bxtnj_virtuemart_product_medias', 'virtuemart_product_id', 'virtuemart_media_id');
    }
    
    public function ru()
    {
      return $this->hasOne('App\VirtuemartProductsRu', 'virtuemart_product_id', 'virtuemart_product_id');
    }
    
    public function manufacturer()
    {
      return $this->hasOne('App\VirtuemartProductManufacturers', 'virtuemart_product_id', 'virtuemart_product_id');
    }

}
