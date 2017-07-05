<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ApiController;

class ProfileImageDetail extends Model
{
    protected $table = 'profile_image_details';
    protected $fillable = ['user_id','original_name','new_name','size','mime_type','extension','path','status'];

    // Variable Declaration
    protected $api;

    // Constructor Function Create Object
    public function __construct() {
        $this->api = new ApiController();
    }

    // Keep User Profile Image Record
    public function keepProfileImageRecord($userId,$originalName,$newName,$size,$mime,$extension,$path) {
        try {

            $pic = new ProfileImageDetail();
            $pic->user_id = $userId;
            $pic->original_name = $originalName;
            $pic->new_name = $newName;
            $pic->size = $size;
            $pic->mime_type = $mime;
            $pic->extension = $extension;
            $pic->path = $path;
            $pic->save();

            return $pic->id;
        } catch(\Exception $e) {

            // Insert Error Log
            $this->api->errorLog("Exception Keep User Profile Image Record",$e->getMessage());

            return $this->api->respondWithError("Oops some technical problem");
        }
    }

    // Count User Pic
    public function countUserPic($userId) {
        try {

            return DB::table('profile_image_details')
                   ->where('user_id',$userId)
                   ->count();

        } catch(\Exception $e) {

            // Insert Error Log
            $this->api->errorLog("Exception Count User Pic",$e->getMessage());

            return $this->api->respondWithError("Oops some technical problem");
        }
    }
}
