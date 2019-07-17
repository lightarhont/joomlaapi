<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class VirtuemartRating extends Model {
    public $timestamps = false;
    protected $table = 'bxtnj_virtuemart_ratings';
    
    protected $primaryKey = 'virtuemart_rating_id';
}