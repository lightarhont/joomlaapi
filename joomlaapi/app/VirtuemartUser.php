<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class VirtuemartUser extends Model {
    public $timestamps = false;
    protected $table = 'bxtnj_users';
    
    protected $primaryKey = 'id';

}