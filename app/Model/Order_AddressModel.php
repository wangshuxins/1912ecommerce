<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order_AddressModel extends Model
{
    //
    protected $table = 'shop_order_address';

    protected  $primaryKey = 'address_id';

    public $timestamps = false;
}
