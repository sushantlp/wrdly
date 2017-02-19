<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ErrorLog extends Model
{
    protected $table = 'error_logs';
    protected $primaryKey='error_id';
    protected $fillable = ['location','description'];

    public function __construct() {
        //$error = new ErrorLog();
    }

    // Insert Error Log
    public function errorLog($msg,$desc) {
        $error = new ErrorLog();
        $error->location = $msg;
        $error->description = $desc;
        $error->save();
        return true;
    }

}
