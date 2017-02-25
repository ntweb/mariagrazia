<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'lab_orders';

    public function user(){
		return $this->belongsTo('\App\User','id_user');
    }

    public function payment(){
		return $this->belongsTo('\App\Payment','id_payment');
    }

    public function shipment(){
		return $this->belongsTo('\App\Shipment','id_shipment');
    }

    public function coupon(){
		return $this->belongsTo('\App\Coupon','id_coupon');
    }

    public function rows() {
        return $this->hasMany('\App\Orderrow', 'id_order');
    }
}
