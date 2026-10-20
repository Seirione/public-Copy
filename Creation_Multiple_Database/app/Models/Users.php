<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = 'users_tb';
    protected $primaryKey ='users_pk';


    protected $fillable =[
    'users_last_name',
    'users_first_name',
    'users_middle_name',
    'isAdmin'
    ];
}
