<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ShipmentMethods extends Model {
    
    public $timestamps = false;
    protected $table = 'bxtnj_virtuemart_shipmentmethods_ru_ru';
    
    protected $primaryKey = 'virtuemart_shipmentmethod_id';
}