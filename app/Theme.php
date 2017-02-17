<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $table = 'themes';
    protected $primaryKey='theme_id';
    protected $fillable = ['theme_name','comment','status'];
}
