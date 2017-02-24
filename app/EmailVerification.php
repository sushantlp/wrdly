<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ApiController;

class EmailVerification extends Model
{
    protected $table = 'email_verifications';
    protected $primaryKey='email_verify_id';
    protected $fillable = ['email','status','email_verify_code'];

    // Variable Declaration
    protected $api;

    // Constructor Function Create Object
    public function __construct() {
        $this->api = new ApiController();
    }

     // Insert Email Otp Code
    public function insertEmailOtp($email,$code) {
        try {

            $emailOtp = new EmailVerification();
            $emailOtp->email = $email;
            $emailOtp->email_verify_code = $code;
            $emailOtp->save();

            return 1;
        } catch(\Exception $e) {

            // Insert Error Log
            $this->api->errorLog("Exception Insert Email Otp Code",$e->getMessage());

            return $this->api->respondWithError("Oops some technical problem");
        }
    }

    // Verify Email Verification Code
    public function verifyEmailCode($email,$code) {
        try {

            $response = DB::table('email_verifications')
                        ->where('email',$email)
                        ->where('email_verify_code',$code)
                        ->first();

            return $response;
        } catch(\Exception $e) {

            // Insert Error Log
            $this->api->errorLog("Exception Email Verification Code",$e->getMessage());

            return $this->api->respondWithError("Oops some technical problem");
        }
    }

    // Deactivate Email Verification Code Status
    public function deactivateEmailCodeStatus($email,$code) {
        try {

            // Call Indian Time Zone
            $timeZone = $this->api->indiaTimeZone();

            DB::table('email_verifications')
            ->where('email',$email)
            ->where('email_verify_code',$code)
            ->update(['status' => 0 ,'updated_at' => $timeZone]);

            return 1;
        } catch(\Exception $e) {

            // Insert Error Log
            $this->api->errorLog("Exception Deactivate Verification Code Status",$e->getMessage());

            return $this->api->respondWithError("Oops some technical problem");
        }
    }

    // Disable Previous Email Otp
    public function disableEmailOtp($email) {
        try {

            // Call Indian Time Zone
            $timeZone = $this->api->indiaTimeZone();

            DB::table('email_verifications')
            ->where('email',$email)
            ->update(['status' => 0 ,'updated_at' => $timeZone]);

            return 1;
        } catch(\Exception $e) {

            // Insert Error Log
            $this->api->errorLog("Disable Email Otp",$e->getMessage());

            return $this->api->respondWithError("Oops some technical problem");
        }
    }
}
