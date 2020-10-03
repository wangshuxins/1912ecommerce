<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order_GoodsModel extends Model
{
    protected $table = 'shop_order_goods';

    protected  $primaryKey = 'order_id';

    public $timestamps = false;
}
