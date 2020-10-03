<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RoleRightModel extends Model
{
    protected $table = 'role_right_rbac';

    protected  $primaryKey = 'id';

    public $timestamps = false;
}
