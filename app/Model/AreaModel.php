<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AreaModel extends Model
{
    protected $table = 'shop_area';

	protected  $primaryKey ='id';

	public $timestamps = false;
}
