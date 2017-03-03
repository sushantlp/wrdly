<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ApiController;

class Thought extends Model
{
    protected $table = 'thoughts';
    protected $fillable = ['habitant_id','theme_id','heart_counter','view_counter','countribute_counter','subscribe_counter','status'];

    // Variable Declaration
    protected $api;

    // Constructor Function Create Object
    public function __construct() {
        $this->api = new ApiController();
    }

    // Get Wrdly Solar World
    public function wrdlySolarSystem($skip) {
        try {

            $jump = $skip * 10;

            $solar = DB::table('thoughts')
                     ->select('thoughts.thought_id as Thought_Id'
                        ,'thoughts.habitant_id as Habitant_Id'
                        ,'users.name as Habitant_Name'
                        ,'thoughts.theme_id as Theme_Id'
                        ,'themes.theme_name as Theme_Name'
                        ,'thoughts.heart_counter as Heart_Count'
                        ,'thoughts.view_counter as View_Count'
                        ,'thoughts.countribute_counter as Countribute_Count'
                        ,'thoughts.subscribe_counter as Subscribe_Counter'
                     )
                     ->leftjoin('habitants','habitants.habitant_id', '=' ,'thoughts.habitant_id')
                     ->leftjoin('users','users.user_id', '=' ,'habitants.user_id')
                     ->leftjoin('themes','themes.theme_id', '=' ,'thoughts.theme_id')
                     ->where('thoughts.status',1)
                     ->orderBy('thoughts.updated_at','desc')
                     ->take(10)
                     ->skip($jump)
                     ->get();

                    return $solar;
        } catch(\Exception $e) {

            // Insert Error Log
            $this->api->errorLog("Exception Get Wrdly Solar World",$e->getMessage());

            return $this->api->respondWithError("Oops some technical problem");
        }
    }

    // Insert Awesome Ideas
    public function createSolarSystem($habitantId,$themeId) {
        try {

            $idea = new Thought();
            $idea->habitant_id = $habitantId;
            $idea->theme_id = $themeId;
            $idea->save();

            return (int) $idea->id;
        } catch(\Exception $e) {

            // Insert Error Log
            $this->api->errorLog("Exception Insert Awesome Ideas",$e->getMessage());

            return $this->api->respondWithError("Oops some technical problem");
        }
    }

    // Get Book Owner
    public function getBookOwner($thoughtId) {
        try {
            $owner = DB::table('thoughts')
                     ->where('thought_id',$thoughtId)
                     ->first();

            return json_decode(json_encode($owner),true);
        } catch(\Exception $e) {

            // Insert Error Log
            $this->api->errorLog("Exception Get Book Owner",$e->getMessage());

            return $this->api->respondWithError("Oops some technical problem");
        }
    }
}
