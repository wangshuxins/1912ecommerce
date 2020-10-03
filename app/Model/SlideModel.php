<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SlideModel extends Model
{
    //
    protected $table = 'shop_slide';

	protected  $primaryKey = 'slide_id';

	public $timestamps = false;
}
