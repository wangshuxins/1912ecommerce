<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AdModel extends Model
{
    //
	protected $table = 'shop_ad';

	protected  $primaryKey ='ad_id';

	public $timestamps = false;



}
