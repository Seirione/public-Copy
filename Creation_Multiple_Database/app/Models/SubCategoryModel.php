<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategoryModel extends Model
{
    protected $table= 'sub_category_tb';
    protected $primaryKey ='sub_category_pk';

    protected $fillable =['Category'];
}
