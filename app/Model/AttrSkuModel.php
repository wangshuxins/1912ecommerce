<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AttrSkuModel extends Model
{
    //
    protected $table = 'shop_attr_attrval_sku';

    protected  $primaryKey ='id';

    public $timestamps = false;
}
