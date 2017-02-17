<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MobileVerification extends Model
{
    protected $table = 'mobile_verifications';
    protected $primaryKey='mobile_verify_id';
    protected $fillable = ['mobile','mobile_verify_code','status'];
}
