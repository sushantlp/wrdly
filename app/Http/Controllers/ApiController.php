<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends CommonLogicController
{
  protected $statusCode = 200;

 // Flush Session value
 public function init(Request $request){
     $request->session()->flush();
 }

// Get Status Code
 public function getStatusCode(){
     return $this->statusCode;
 }

 // Set Status Code
 public function setStatusCode($statusCode) {
     $this->statusCode = $statusCode;
 }

 // Respond Not Found
 public function respondNotFound($message = 'Not Found'){
     $this->setStatusCode(404);
     return $this->respondWithError($message);
 }

 // Send Respond Error
 public function respondWithError($message){
     return $this->respond([
         'wrdly_error' => [
             'wrdly' => $message,
             'code' => 333,
         ]
     ]);
 }

// Send Success Message
 public function respondWithMessage($message){
     return $this->respond([
         'wrdly_success' => [
             'wrdly' => $message,
             'code' => 666,
         ]
     ]);
 }

// Encode in Json
 public function respond($data){
     return json_encode($data);
 }
}
