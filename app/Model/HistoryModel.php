<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
//浏览记录表
class HistoryModel extends Model
{
    protected $table = 'shop_history';

	protected  $primaryKey = 'h_id';

	public $timestamps = false;
}
