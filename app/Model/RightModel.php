<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RightModel extends Model
{
    protected $table = 'shop_right_rbac';

    protected  $primaryKey = 'right_id';

    public $timestamps = false;
}
