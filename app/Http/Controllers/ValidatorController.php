<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ValidatorController extends ApiController
{
    // Validate Incoming Signup Request
    public function signupValidator($request) {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6|max:15',
            'name' => 'required',
            'email'=> array('Regex:/^[A-Za-z0-9._+\-\']+@[A-Za-z0-9.\-]+\.[A-Za-z]{2,}$/','required'),
        ]);

        if($validator->fails()) {
            $validator->errors()->add('Signup has failed !');
            $errors = $validator->errors();
            return $this->respondWithError($errors);
        } else {
            return 1;
        }
    }

    // Validate Incoming Signup Request
    public function loginValidator($request) {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6|max:15',
            'email'=> array('Regex:/^[A-Za-z0-9._+\-\']+@[A-Za-z0-9.\-]+\.[A-Za-z]{2,}$/','required'),
        ]);

        if($validator->fails()) {
            $validator->errors()->add('Login has failed !');
            $errors = $validator->errors();
            return $this->respondWithError($errors);
        } else {
            return 1;
        }
    }
}
