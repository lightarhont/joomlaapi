<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model {
    public $timestamps = false;
    protected $table = 'orders';
    
    protected $primaryKey = 'id';

    protected $fillable = [
       0 => "user_id",
    ];

    // Relationships
    
    public function products()
    {
        return $this->belongsToMany('App\VirtuemartProducts', 'orderproduct', 'order_id', 'product_id')->withPivot('quantity', 'params');
    }
}