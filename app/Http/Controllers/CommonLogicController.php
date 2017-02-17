<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\ErrorLog;

class CommonLogicController extends Controller
{
    // Create  Model Object
    protected $errorObject = new ErrorLog();

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
            $errorObject->errorLog("Exception Insert User Detail",$e);

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
            $errorObject->errorLog("Exception Generate Code",$e);

            return $this->respondWithError("Oops some technical problem");
        }
    }

    // Mail Send Jobs
    public function sendEmail($proxy,$template,$email,$msg) {
        try {
            $this->dispatch(new SendEmail($proxy,$template,$email,$msg));
            return 1;
        } catch(\Exception $e) {

            // Insert Error Log
            $errorObject->errorLog("Exception Mail Send",$e);

            return $this->respondWithError("Oops some technical problem");
        }
    }

}
