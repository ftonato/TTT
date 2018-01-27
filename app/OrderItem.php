<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
    use SoftDeletes;

    protected $fillable = ['order_id', 'product_id', 'quantity'];
    protected $dates = ['deleted_at'];

    public function order() {
    	return $this->belongsTo('App\Order');
    }

    public function products() {
        return $this->hasMany('App\Product', 'id', 'product_id');
    }
}