<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'unit_id',
        'name'
    ];
    
    public function unit() 
    {
        return $this->belongsTo('App\Unit');
    }

    public function stores()
    {
        return $this->belongsToMany('App\Store', 'products_store')
            ->withPivot('product_price');
    }
}
