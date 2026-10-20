<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\SubCategoryModel;

class ProductModel extends Model
{
    protected $table = 'products_tb';
    protected $primaryKey = 'products_pk';

    protected $fillable =[
        'products_name',
        'products_amount',
        'SKU',
        'products_category_fk',
 
    ];

     public function category()
    {
        // belongsTo(TargetModel, foreign_key_on_this_table, primary_key_on_other_table)
        return $this->belongsTo(SubCategoryModel::class, 'products_category_fk', 'sub_category_pk');
    }
}
