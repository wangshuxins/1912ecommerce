<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CollectModel extends Model
{
    protected $table = 'shop_collect';
    protected  $primaryKey = 'id';
    public $timestamps = false;
}
