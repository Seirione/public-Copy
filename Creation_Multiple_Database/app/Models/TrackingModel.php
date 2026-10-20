<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrackingModel extends Model
{
    protected $table ='tracking_tb';
    protected $primaryKey = 'tracking_pk';


    protected $fillable = [
        'product_id',
        'products_pk',
        'product_amount',
        'products_tb'
    ];
}
