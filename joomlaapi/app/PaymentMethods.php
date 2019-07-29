<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethods extends Model {
    
    public $timestamps = false;
    protected $table = 'bxtnj_virtuemart_paymentmethods';
    
    protected $primaryKey = 'virtuemart_paymentmethod_id';
    
    public function ru()
    {
      return $this->hasOne('App\PaymentMethodsRu', 'virtuemart_paymentmethod_id', 'virtuemart_paymentmethod_id');
    }
}