<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    protected $table = 'genders';
    protected $primaryKey='gender_id';
    protected $fillable = ['name','status'];
}
