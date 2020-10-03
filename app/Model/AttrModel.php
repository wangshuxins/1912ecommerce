<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AttrModel extends Model
{
    //
    protected $table = 'shop_attr_sku';

	protected  $primaryKey = 'id';

	public $timestamps = false;
}
