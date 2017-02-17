<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thought extends Model
{
    protected $table = 'thoughts';
    protected $primaryKey='thought_id';
    protected $fillable = ['habitant_id','theme_id','heart_counter','view_counter','countribute_counter','subscribe_counter','status'];
}
