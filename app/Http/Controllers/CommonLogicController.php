<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuthExceptions\JWTException;
use App\User;
use App\ErrorLog;
use App\Jobs\SendEmail;

class CommonLogicController extends ErrorLog
{

    // Constructor Function Create Object
    public function __construct() {

    }



    // Insert User Detail in User Table
    public function insertUserDetail($name,$email,$password,$mobile,$rollId) {
        try {
            $user = new User();
            $user->name = $name;
            $user->email = $email;
            $user->mobile = $mobile;
            $user->password = Hash::make($password);
            $user->role_id = $rollId;
            $user->save();

            return $user->id;
        } catch(\Exception $e) {

            // Insert Error Log
            $this->errorLog("Exception Insert User Detail",$e->getMessage());

            return $this->respondWithError("Oops some technical problem");
        }
    }

    // Generate Random Code
    public function generateCode($length = 10) {
        try {
            $characters = '123456789';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return (int)$randomString;
        } catch(\Exception $e) {

            // Insert Error Log
            $this->errorLog("Exception Generate Code",$e->getMessage());

            return $this->respondWithError("Oops some technical problem");
        }
    }

    // Mail Send Jobs
    public function sendEmail($proxy,$template,$email,$msg) {
        try {
            dispatch(new SendEmail($proxy,$template,$email,$msg));
            return 1;
        } catch(\Exception $e) {

            // Insert Error Log
            $this->errorLog("Exception Mail Send",$e->getMessage());

            return $this->respondWithError("Oops some technical problem");
        }
    }

    // User Credential Verify
    public function verifyUserCredential($email,$password) {
        try {
            // Get User Detail By email
            $verify = $this->getUserDetailByEmail($email);
            $arr = array();
            if(is_object($verify)) {
                if($verify->status == 0) {
                    if($verify->email_active == 0) {
                        return $this->respondWithMessage("Please verify your account");
                    } else {
                        return $this->respondWithMessage("InActive user");
                    }
                }

                if(Hash::check($password,$verify->password)) {
                   return $verify;
                } else {
                   return $this->respondWithMessage("Password fail");
                }
            } else {
                return $verify;
            }
        } catch(\Exception $e) {

            // Insert Error Log
            $this->errorLog("Exception User Credential Verify",$e->getMessage());

            return $this->respondWithError("Oops some technical problem");
        }
    }

    // Get User Information By Email
    public function getUserDetailByEmail($email) {
        try {
            $info = DB::table('users')
                      ->where('email',$email)
                      ->first();
            if($info) {
                return $info;
            } else {
                return $this->respondWithMessage("Invalid user");
            }
        } catch(\Exception $e) {

            // Insert Error Log
            $this->errorLog("Exception Get User Information By Email",$e->getMessage());

            return $this->respondWithError("Oops some technical problem");
        }
    }

    // JWT Token Without Request
   public function generateToken($credential,$role) {
       try {
           $arr = array();
           $token = JWTAuth::fromUser($credential);
           $arr['Token'] = $token;
           $arr['Role'] = $role;
           return $arr;
       } catch(JWTException $e) {

           // Insert Log Information
           $this->errorLog('Exception Generate Token',$e->getMessage());

           // something went wrong
           if($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
               return $this->respondWithError("Token is Invalid");
           } else if($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
               return $this->respondWithError("Token is Expired");
           } else{
               return $this->respondWithError("Something is wrong");
           }
       }
   }

   // Activate User Account
   public function activateUserAccount($email) {
       try {

           // Call Indian Time Zone
           $timeZone = $this->indiaTimeZone();

           DB::table('users')
           ->where('email',$email)
           ->update(['email_active' => 1 ,'status' => 1 ,'updated_at' => $timeZone]);

           return 1;
       } catch(\Exception $e) {

           // Insert Error Log
           $this->errorLog("Exception Activate User Account",$e->getMessage());

           return $this->respondWithError("Oops some technical problem");
       }
   }

   // Get India Time And Date
   public function indiaTimeZone() {
       date_default_timezone_set("Asia/Kolkata");
       $todayDateTime = new \DateTime();
       $todayDate = $todayDateTime->format('Y:m:d H:i:s');
       return $todayDate;
   }

   // Put User Email in Session
   public function loginSession($request,$email) {
       // Via a request instance...
       $request->session()->put('email', $email);
       return true;
   }

   // Update User Detail
   public function updateUserDetail($name,$mobile,$email) {
       try {

           // Call Indian Time Zone
           $timeZone = $this->indiaTimeZone();

           DB::table('users')
           ->where('email',$email)
           ->update(['name' => $name ,'mobile' => $mobile ,'updated_at' => $timeZone]);

           return 1;
       } catch(\Exception $e) {

           // Insert Error Log
           $this->errorLog("Exception Update User Detail",$e->getMessage());

           return $this->respondWithError("Oops some technical problem");
       }
   }
}
