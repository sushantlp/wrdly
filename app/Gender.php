<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ApiController;

class Gender extends Model
{
    protected $table = 'genders';
    protected $primaryKey='gender_id';
    protected $fillable = ['name','status'];

    // Variable Declaration
    protected $api;

    // Constructor Function Create Object
    public function __construct() {
        $this->api = new ApiController();
    }

    // Get All Wrdly Gender
    public function wrdlyGender() {
        try {

            return  DB::table('genders')
                    ->select('gender_id as Gender_Id','name as Gender_Name')
                    ->where('status',1)
                    ->get();

        } catch(\Exception $e) {

            // Insert Error Log
            $this->api->errorLog("Exception Get All Wrdly Gender",$e->getMessage());

            return $this->api->respondWithError("Oops some technical problem");
        }
    }
}
