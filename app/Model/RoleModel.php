<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RoleModel extends Model
{
     //
    protected $table = 'shop_role_rbac';

	protected  $primaryKey = 'role_id';

	public $timestamps = false;
}
