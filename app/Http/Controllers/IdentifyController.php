<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\ValidatorController;
use App\EmailVerification;

class IdentifyController extends ApiController
{
    // Variable Declaration
    protected $emailObject;
    protected $validation ;

    // Constructor Function
    public function __construct(EmailVerification $emailObject,ValidatorController $validation) {
        $this->emailObject = $emailObject;
        $this->validation = $validation;
    }

    // User Signup
    public function signup(Request $request) {
      if(($request->isMethod('post'))) {

          // Call Signup Validator Function
          $promise = $this->validation->signupValidator($request);

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
          $emailOtp = $this->emailObject->insertEmailOtp($email,$code);
          if(!is_numeric($emailOtp)) {
              return $emailOtp;
          }

          // Send Email Verification Code
          $arr = array();
          $arr['code'] = $code;
          $arr['email'] = $email;
          $template = 'mail.blade.php';
          $subject = 'Welcome to the Wrdly be Creative!';
          $sendEmail = $this->sendEmail($arr,$template,$email,$subject);

          if(!is_numeric($sendEmail)) {
              return $sendEmail;
          }

          return $this-respondWithSuccess("Successful");
      } else {
          return $this->respondWithError("Not a good api call");
      }
    }

    // Email Verification
    public function emailVerifiy(Request $request) {
        if(($request->isMethod('get') && $request->has('code') && $request->has('email'))) {

            $email = $request->input('email');
            $code = $request->input('code');

            // Verify Email Verification Code
            $check = $this->emailObject->verifyEmailCode($email,$code);
            if(is_string($check)) {
                return $check;
            }

            // Deactivate Email Verification Code Status
            $turnOff = $this->deactivateEmailCodeStatus($email,$code);
            if(!is_numeric) {
                return $turnOff;
            }

            return $this-respondWithSuccess("Successful verification");
        } else {
            return $this->respondWithError("Not a good api call");
        }
    }

    // User Login Request
    public function userLogin(Request $request) {
        if($request->isMethod('get') && $request->has('password') && $request->has('email')) {
            $email = $request->input('email');
            $password = $request->input('password');
            $arr = array();

            // Call Signup Validator Function
            $promise = $this->validation->loginValidator($request);

            // If Return Value is Not Numeric Validation Fail
            if(!is_numeric($promise)) {
                return $promise;
            }

            // User Credential Verify
            $verify = $this->verifyUserCredential($email,$password);
            if(is_string($verify)) {
                return $verify;
            }

            // Generate JWT Token
            $token = $this->generateToken($verify);
            if(is_string($token)) {
                return $token;
            }

            $arr['Primary_Id'] = $verify->user_id;
            $arr['User_Name'] = $verify->name;
            $arr['User_Mobile'] = $verify->mobile;
            $arr['User_Email'] = $verify->email;
            $arr['Role'] = $verify->role_id;
            $arr['Active'] = $verify->status;
            $arr['Token'] = $token;

            return $arr;

        } else {
        }
            return $this->respondWithError("Not a good api call");
    }
}
