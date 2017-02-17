<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    protected $table = 'days';
    protected $primaryKey='day_id';
    protected $fillable = ['day','status'];
}
