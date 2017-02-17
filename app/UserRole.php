<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = 'user_roles';
    protected $primaryKey='role_id';
    protected $fillable = ['role_name','status'];
}
