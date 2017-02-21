<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ApiController;

class Habitant extends Model
{
    protected $table = 'habitants';
    protected $primaryKey='habitant_id';
    protected $fillable = ['user_id','state','city','address','latitude','longtitude','gender_id'];

    // Variable Declaration
    protected $api;

    // Constructor Function Create Object
    public function __construct() {
        $this->api = new ApiController();
    }

    // Insert Habitant Complete Information
    public function insertHabitantDetail($userId,$state,$city,$address,$latitude,$longtitude,$gender) {
        try {

            $habitant = new Habitant();
            $habitant->user_id = $userId;
            $habitant->state = $state;
            $habitant->city = $city;
            $habitant->gender_id = $gender;
            $habitant->address = $address;
            $habitant->latitude = $latitude;
            $habitant->longtitude = $longtitude;
            $habitant->save();

            return (int) $habitant->id;
        } catch(\Exception $e) {

            // Insert Error Log
            $this->api->errorLog("Exception Insert Habitant Complete Information",$e->getMessage());

            return $this->api->respondWithError("Oops some technical problem");
        }
    }

    // Update Habitant Complete Information
    public function updateHabitantDetail($userId,$state,$city,$address,$latitude,$longtitude,$gender) {
        try {

            // Call Indian Time Zone
            $timeZone = $this->api->indiaTimeZone();

            DB::table('habitants')
            ->where('user_id',$userId)
            ->update(['state' => $state ,'city' => $city ,'gender_id' => $gender
                ,'address' => $address ,'latitude' => $latitude
                ,'longtitude' => $longtitude ,'updated_at' => $timeZone
            ]);

            return 1;
        } catch(\Exception $e) {

            // Insert Error Log
            $this->api->errorLog("Exception Update Habitant Complete Information",$e->getMessage());

            return $this->api->respondWithError("Oops some technical problem");
        }
    }
}
