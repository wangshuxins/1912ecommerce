<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Shop_codemodel extends Model
{
    protected $table = 'shop_code';

	protected  $primaryKey = 'code_id';

	public $timestamps = false;
}
