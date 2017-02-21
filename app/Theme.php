<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ApiController;

class Theme extends Model
{
    protected $table = 'themes';
    protected $primaryKey='theme_id';
    protected $fillable = ['theme_name','comment','status'];

    // Variable Declaration
    protected $api;

    // Constructor Function Create Object
    public function __construct() {
        $this->api = new ApiController();
    }

    // Get Wrdly Theme
    public function wrdlyTheme() {
        try {

            $day = DB::table('themes')
                   ->select('theme_id as Theme_Id'
                        ,'theme_name as Theme_Name'
                        ,'comment as Description'
                   )
                   ->where('status',1)
                   ->get();

            return $day;
        } catch(\Exception $e) {

            // Insert Error Log
            $this->api->errorLog("Exception Get Wrdly Theme",$e->getMessage());

            return $this->api->respondWithError("Oops some technical problem");
        }
    }
}
