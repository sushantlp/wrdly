<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ValidatiorController extends ApiController
{
    // Validate Incoming Signup Request
    public function signupValidator($request) {
        $validator = Validator::make($data->all(), [
            'password' => 'required|min:6|max:15',
            'name' => 'required',
            'email'=> array('Regex:/^[A-Za-z0-9._+\-\']+@[A-Za-z0-9.\-]+\.[A-Za-z]{2,}$/','required'),
        ]);

        if($validator->fails()) {
            $validator->errors()->add('Signup has failed !');
            $errors = $validator->errors();
            return $this->respondWithError($errors);
        }else {
            return 1;
        }
    }
}
