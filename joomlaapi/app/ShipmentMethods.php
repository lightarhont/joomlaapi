<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ShipmentMethods extends Model {
    
    public $timestamps = false;
    protected $table = 'bxtnj_virtuemart_shipmentmethods';
    
    protected $primaryKey = 'virtuemart_shipmentmethod_id';
    
    public function ru()
    {
      return $this->hasOne('App\ShipmentMethodsRu', 'virtuemart_shipmentmethod_id', 'virtuemart_shipmentmethod_id');
    }
}