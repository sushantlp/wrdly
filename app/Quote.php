<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ApiController;

class Quote extends Model
{
    protected $table = 'quotes';
    protected $primaryKey='quote_id';
    protected $fillable = ['quote_of_day','writer_name','day_id','status'];

    // Variable Declaration
    protected $api;

    // Constructor Function Create Object
    public function __construct() {
        $this->api = new ApiController();
    }

    // Get Wrdly Depend Upon Day Quote
    public function wrdlyDayQuote($dayId) {
        try {

            $day = DB::table('quotes')
                   ->select('quote_id as Quote_Id'
                        ,'quote_of_day as Quote_Day'
                        ,'writer_name as Writer_Name'
                        ,'day_id as Day_Id'
                   )
                   ->where('day_id',$dayId)
                   ->where('status',1)
                   ->first();

            return $day;
        } catch(\Exception $e) {

            // Insert Error Log
            $this->api->errorLog("Exception Get Wrdly Theme",$e->getMessage());

            return $this->api->respondWithError("Oops some technical problem");
        }
    }
}
