<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = ['company_id', 'user_id', 'status'];
    protected $dates = ['deleted_at'];

    public function company() {
    	return $this->belongsTo('App\Company');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function orderItems() {
        return $this->hasMany('App\OrderItem');
    }
}