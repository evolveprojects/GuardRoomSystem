<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class UserPermission extends Model
{
     use HasFactory, Loggable;



    protected $table = 'user_has_permissions';



    protected $fillable = ['user_id','permission_id'];
}
