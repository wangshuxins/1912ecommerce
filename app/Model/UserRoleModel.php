<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserRoleModel extends Model
{
    protected $table = 'admin_role_rbac';

    protected  $primaryKey = 'id';

    public $timestamps = false;
}
