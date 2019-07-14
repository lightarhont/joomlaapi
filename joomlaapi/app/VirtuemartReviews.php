<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class VirtuemartReviews extends Model {
    public $timestamps = false;
    protected $table = 'bxtnj_virtuemart_rating_reviews';
    
    protected $primaryKey = 'virtuemart_rating_review_id';

    // Relationships
    
    public function product()
    {
      return $this->hasOne('App\VirtuemartProducts', 'virtuemart_product_id', 'virtuemart_product_id');
    }
}