<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ApiController;

class Day extends Model
{
    protected $table = 'days';
    protected $primaryKey='day_id';
    protected $fillable = ['day','status'];

    // Variable Declaration
    protected $api;

    // Constructor Function Create Object
    public function __construct() {
        $this->api = new ApiController();
    }

    // Get Wrdly Day
    public function wrdlyDay() {
        try {

            $day = DB::table('days')
                   ->select('day_id as Day_Id'
                        ,'day as Day_Name'
                   )
                   ->where('status',1)
                   ->get();

            return $day;
        } catch(\Exception $e) {

            // Insert Error Log
            $this->api->errorLog("Exception Get Wrdly Day",$e->getMessage());

            return $this->api->respondWithError("Oops some technical problem");
        }
    }
}
