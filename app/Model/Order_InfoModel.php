<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order_InfoModel extends Model
{
    protected $table = 'shop_order_info';

    protected  $primaryKey = 'order_goods_id';

    public $timestamps = false;
}
