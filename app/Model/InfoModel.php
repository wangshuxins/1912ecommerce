<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class InfoModel extends Model
{
    protected $table = 'shop_user_info';

    protected  $primaryKey = 'id';

    public $timestamps = false;
}
