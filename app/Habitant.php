<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Habitant extends Model
{
    protected $table = 'habitants';
    protected $primaryKey='habitant_id';
    protected $fillable = ['user_id','state','city','address','latitude','longtitude'];

    public function insertHabitantDetail() {

    }
}
