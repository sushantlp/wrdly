<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ErrorLog extends Model
{
    protected $table = 'error_logs';
    protected $primaryKey='error_id';
    protected $fillable = ['location','description'];


    // Insert Error Log
    public function errorLog($msg,$error) {
        $error = new ErrorLog();
        $error->location = $msg;
        $error->description = $error;
        $error->save();

        return true;
    }
}
