<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethodsRu extends Model {
    
    public $timestamps = false;
    protected $table = 'bxtnj_virtuemart_paymentmethods_ru_ru';
    
    protected $primaryKey = 'virtuemart_paymentmethod_id';
}