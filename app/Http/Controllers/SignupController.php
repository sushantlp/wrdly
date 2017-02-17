<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\ValidatiorController;
use App\MobileVerification;
use App\EmailVerification;

class SignupController extends ApiController
{
    // Create Error Log Model Object
    protected $habitantObject = new Habitant();
    protected $emailObject = new EmailVerification();

    // User Signup
    public function signup(Request $request) {
      if(($request->isMethod('post'))) {

          // Create ValidatiorController Object
          $validation = new ValidatiorController();

          // Call Signup Validator Function
          $promise = $validation->signupValidator($request);

          // If Return Value is Not Numeric Validation Fail
          if(!is_numeric($promise)) {
              return $promise;
          }

          // Extract Request value
          $name = $request->input('name');
          $email = $request->input('email');
          $password = $request->input('password');
          $rollId = 1;

          // Insert User Detail in User Table
          $insertUser = $this->insertUserDetail($name,$email,$password,null,$rollId);
          if(!is_numeric($insertUser)) {
              return $insertUser;
          }

          // Generate Otp Code
          $code = $this->generateCode();
          if(!is_numeric($code)) {
              return $code;
          }

          // Insert Email Otp Code
          $emailOtp = $emailObject->insertEmailOtp($email,$code);
          if(!is_numeric($emailOtp)) {
              return $emailOtp;
          }

          // Send Email Verification Code
          $arr = array();
          $arr['code'] = $code;
          $arr['email'] = $email;
          $template = 'mail.blade.php'
          $subject = 'Welcome to the Wrdly be Creative!'
          $sendEmail = $this->sendEmail($arr,$template,$email,$subject);

          if(!is_numeric($sendEmail)) {
              return $sendEmail;
          }

          return $this-respondWithMessage("Successful");
      } else {
          return $this->respondWithError("Not a good api call");
      }
    }

    // Email Verification
    public function emailVerifiy(Request $request) {
        if(($request->isMethod('get')) && $request->has('code') && $request->has('email')) {
            $email = $request->input('email');
            $code = $request->input('code');

            // Verify Email Verification Code
            $check = $emailObject->verifyEmailCode($email,$code);
            if(is_string($check)) {
                return $check;
            }

            // Deactivate Email Verification Code Status
            $turnOff = $this->deactivateEmailCodeStatus($email,$code);
            if(!is_numeric) {
                return $turnOff;
            }

            return $this-respondWithMessage("Successful verification");
        } else {
            return $this->respondWithError("Not a good api call");
        }
    }
}
