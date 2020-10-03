<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User_AddressModel extends Model
{
     //
     protected $table = 'shop_user_address';

     protected  $primaryKey = 'id';
 
     public $timestamps = false;
}
