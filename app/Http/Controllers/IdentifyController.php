<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\ValidatorController;
use App\EmailVerification;
use App\Jobs\SendEmail;

class IdentifyController extends ApiController
{
    // Variable Declaration
    protected $validation ;
    protected $emailObject;

    // Constructor Function Create Object
    public function __construct(ValidatorController $validation,EmailVerification $emailObject) {
        $this->validation = $validation;
        $this->emailObject = $emailObject;
    }

    // User Signup
    public function signup(Request $request) {
      if($request->isMethod('post') && $request->has('name') && $request->has('email') && $request->has('password')) {

          // Call Signup Validator Function
          $promise = $this->validation->signupValidator($request);

          // If Return Value is Not Numeric Validation Fail
          if(!is_numeric($promise)) {
              return $promise;
          }

          // Extract Request Parameter value
          $email = $request->input('email');
          $name = $request->input('name');
          $password = $request->input('password');
          $rollId = 1;

          // Check User Already Registered
          $check = $this->getUserDetailByEmail($email);

          if(is_string($check)) {
              return $check;
          }

          $check = json_decode(json_encode($check),true);
          if(!empty($check)) {
              return $this->respondWithMessage("You already signup! please login");
          }

          // Insert User Detail in User Table
          $insertUser = $this->insertUserDetail($name,$email,$password,null,$rollId);
          if(!is_numeric($insertUser)) {
              return $insertUser;
          }

          // Generate Otp Code
          $code = $this->generateCode(5);
          if(!is_numeric($code)) {
              return $code;
          }

          // Disable Previous Email Otp
          $disable = $this->emailObject->disableEmailOtp($email);
          if(!is_numeric($disable)) {
              return $disable;
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
          $template = 'mail';
          $subject = 'Welcome to the Wrdly be Creative!';
          $sendEmail = $this->sendEmail($arr,$template,$email,$subject);


          if(!is_numeric($sendEmail)) {
              return $sendEmail;
          }

          return $this->respondWithSuccess("Successful");
      } else {
          return $this->respondWithError("Not a good api call");
      }
    }

    // Email Verification
    public function emailVerifiy(Request $request) {
        if($request->isMethod('get') && $request->has('code') && $request->has('email')) {

            // Extract Request Parameter value
            $email = $request->input('email');
            $code = $request->input('code');

            // Verify Email Verification Code
            $check = $this->emailObject->verifyEmailCode($email,$code);

            if(is_string($check)) {
                return $check;
            }

            $check = json_decode(json_encode($check),true);
            if(empty($check)) {
                return $this->respondWithMessage("Wrong code verification fail!");
            }

            // Check Email Code Status
            if($check['status'] == 0) {
                return $this->respondWithMessage("You already verify your account! please login");
            }

            // Deactivate Email Verification Code Status
            $turnOff = $this->emailObject->deactivateEmailCodeStatus($email,$code);
            if(!is_numeric($turnOff)) {
                return $turnOff;
            }

            $turnOn = $this->activateUserAccount($email);
            if(!is_numeric($turnOn)) {
                return $turnOn;
            }

            return $this->respondWithSuccess("Successful verification");
        } else {
            return $this->respondWithError("Not a good api call");
        }
    }

    // User Login Request
    public function userLogin(Request $request) {
        if($request->isMethod('post') && $request->has('password') && $request->has('email')) {

            // Extract Request Parameter value
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
            $token = $this->generateToken((object)$verify,$verify['role_id']);
            if(is_string($token)) {
                return $token;
            }

            // Put User Email in Session
            $session = $this->loginSession($request,$email);

            $arr['Primary_Id'] = $verify['user_id'];
            $arr['User_Name'] = $verify['name'];
            $arr['User_Mobile'] = $verify['mobile'];
            $arr['User_Email'] = $verify['email'];
            $arr['Active'] = $verify['status'];
            $arr['Token'] = $token;

            return $this->respondWithSuccess($arr);

        } else {
            return $this->respondWithError("Not a good api call");
        }
    }

    public function tokenRegenerate(Request $request) {
        if($request->isMethod('post') && $request->has('password') && $request->has('email')) {

            // Extract Request Parameter value
            $email = $request->input('email');
            $password = $request->input('password');

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
            $token = $this->generateToken((object)$verify,$verify['role_id']);
            if(is_string($token)) {
                return $token;
            }

            return $this->respondWithSuccess($token);
        } else {
            return $this->respondWithError("Not a good api call");
        }
    }

}
