<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SignupController extends ApiController
{
    // Merchant App Verify
    public function signup(Request $request) {
      if(($request->isMethod('get'))) {
          $v = new SignupValidation();
          $validate = $v->validateMerchantApp($request);
          $mobile = $request->input('mobile');
          $check = $this->dailySmsLimit($mobile,3);
          if($check == -1) {
              return $this->respondWithError("Problem occur count mobile otp");
          }
          if(is_numeric($validate)) {
              if($check == 1) {
                  $otp = $this->generateOTP();
                  $response = $this->InsertMobileOTP($mobile,$otp['mobile']);
                  if($response == -1) {
                      return $this->respondWithError("Problem Occur Insert Mobile OTP");
                  }
                  return $this->respond([
                      'sense_success' => [
                          'sense8' => "OTP send respective user mobile number",
                          'code' => 666,
                      ]
                  ]);
              } else {
                  return $this->respondWithError("You have exceeded your OTP request limit, please try again 24 hour");
              }
          } else {
              return $validate;
          }

      } else {
          $this->respondWithMessage("Not a good api call");
      }
    }
}
