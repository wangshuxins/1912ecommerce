<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    protected $table = 'shop_cate';

	protected  $primaryKey = 'cate_id';

	public $timestamps = false;
}
