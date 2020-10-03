<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{
    protected $table = 'shop_cary';

    protected  $primaryKey ='cary_id';

    public $timestamps = false;
}
