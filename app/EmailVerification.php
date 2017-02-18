<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailVerification extends Model
{
    protected $table = 'email_verifications';
    protected $primaryKey='email_verify_id';
    protected $fillable = ['email','status','email_verify_code'];

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
            $errorObject->errorLog("Exception Insert Email Otp Code",$e);

            return $this->respondWithError("Oops some technical problem");
        }
    }

    // Verify Email Verification Code
    public function verifyEmailCode($email,$code) {
        try {
            $response = DB::table('email_verifications')
                        ->where('email',$email)
                        ->where('email_verify_code',$code)
                        ->first();
            if($response) {
                return $response;
            } else {
                return $this->respondWithMessage("Wrong code verification fail!");
            }
        } catch(\Exception $e) {

            // Insert Error Log
            $errorObject->errorLog("Exception Email Verification Code",$e);

            return $this->respondWithError("Oops some technical problem");
        }
    }

    // Deactivate Email Verification Code Status
    public function deactivateEmailCodeStatus($email,$code) {
        try {
            DB::table('email_verifications')
            ->where('email',$email)
            ->where('email_verify_code',$code)
            ->update(['status' => 0]);

            return 1;
        } catch(\Exception $e) {

            // Insert Error Log
            $errorObject->errorLog("Exception Deactivate Verification Code Status",$e);

            return $this->respondWithError("Oops some technical problem");
        }
    }
}
