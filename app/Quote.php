<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $table = 'quotes';
    protected $primaryKey='quote_id';
    protected $fillable = ['quote_of_day','writer_name','day_id','status'];
}
