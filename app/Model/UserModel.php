<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
//用户表
class UserModel extends Model
{
    protected $table = 'shop_user';

	protected  $primaryKey = 'user_id';

	public $timestamps = false;
}
