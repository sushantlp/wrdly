<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Habitant;
use App\Gender;
use App\Day;
use App\Theme;
use App\Quote;
use App\Thought;
use App\NotionBook;

class HabitantController extends ApiController
{
    // Variable Declaration
    protected $habitantObject;
    protected $genderObject;
    protected $dayObject;
    protected $themeObject;
    protected $quoteObject;
    protected $thoughtObject;
    protected $notionBookObject;


    // Constructor Function Create Object
    public function __construct(NotionBook $notionBookObject, Thought $thoughtObject, Habitant $habitantObject, Gender $genderObject, Day $dayObject, Theme $themeObject, Quote $quoteObject) {

        $this->thoughtObject = $thoughtObject;
        $this->notionBookObject = $notionBookObject;
        $this->habitantObject = $habitantObject;
        $this->genderObject = $genderObject;
        $this->dayObject = $dayObject;
        $this->themeObject = $themeObject;
        $this->quoteObject = $quoteObject;
    }


    public function completeProfile(Request $request) {
        if($request->isMethod('post') && $request->has('gender') && $request->has('mobile') && $request->has('state') && $request->has('city') && $request->has('address')) {

            // Extract Request Parameter value
            $mobile = $request->input('mobile');
            $state = $request->input('state');
            $city = $request->input('city');
            $address = $request->input('address');
            $latitude = $request->input('latitude');
            $longtitude = $request->input('longtitude');
            $gender = $request->input('gender');

            // Get Session Value
            $email = $request->session()->get('email');

            // Get User Information By Email
            $info = $this->getUserDetailByEmail($email);
            if(is_string($info)) {
                return $info;

            }

            // Update User Detail
            $update = $this->updateUserDetail($info->name,$mobile,$email);
            if(!is_numeric($update)) {
                return $update;
            }

            // Insert Habitant Complete Information
            $insert = $this->habitantObject->insertHabitantDetail($info->user_id,$state,$city,$address,$latitude,$longtitude,$gender);
            if(!is_numeric($insert)) {
                return $insert;
            }

            return $this->respondWithSuccess("Successful");

        } else {
            return $this->respondWithError("Not a good api call");
        }

    }
    public function updateProfile(Request $request) {
        if($request->isMethod('post') && $request->has('gender') && $request->has('mobile') && $request->has('state') && $request->has('city') && $request->has('address')) {

            // Extract Request Parameter value
            $mobile = $request->input('mobile');
            $state = $request->input('state');
            $city = $request->input('city');
            $address = $request->input('address');
            $latitude = $request->input('latitude');
            $longtitude = $request->input('longtitude');
            $gender = $request->input('gender');

            // Get Session Value
            $email = $request->session()->get('email');

            // Get User Information By Email
            $info = $this->getUserDetailByEmail($email);
            if(is_string($info)) {
                return $info;

            }

            // Update User Detail
            $updateUser = $this->updateUserDetail($info->name,$mobile,$email);
            if(!is_numeric($updateUser)) {
                return $updateUser;
            }

            // Update Habitant Complete Information
            $updateHabitant = $this->habitantObject->updateHabitantDetail($info->user_id,$state,$city,$address,$latitude,$longtitude,$gender);
            if(!is_numeric($updateHabitant)) {
                return $updateHabitant;
            }

            return $this->respondWithSuccess("Successful");
        } else {
            return $this->respondWithError("Not a good api call");
        }
    }

    // Request Get Wrdly Static Data
    public function getStaticData(Request $request) {
        if($request->isMethod('get')) {

            // Array Variable Declaration
            $arr = array();
            $dayId = 0;

            // Get Indian Time Zone
            date_default_timezone_set("Asia/Kolkata");

            // Convert Date in Numeric Format
            $day = date('D',strtotime());

            // Get Wrdly Gender
            $gender = $this->genderObject->wrdlyGender();

            // Get Wrdly Day
            $day = $this->dayObject->wrdlyDay();

            if(is_array($day)) {
                $specific = json_decode(json_encode($day),true);
                foreach($specific as $DY) {
                    if($day == $DY['Day_Name']) {
                        $dayId = $DY['Day_Id'];
                    }
                }
            }

            // Get Wrdly Theme
            $theme = $this->themeObject->wrdlyTheme();

            // Get Wrdly Depend Upon Day Quote
            $quote = $this->quoteObject->wrdlyDayQuote($dayId);


            // Intialization  Variable
            $arr['Gender'] = $gender;
            $arr['Day'] = $day;
            $arr['Theme'] = $theme;
            $arr['Quote'] = $quote;

            return $this->respondWithSuccess($arr);
        } else {
            return $this->respondWithError("Not a good api call");
        }
    }

    // Request Solar World
    public function getSolarSystem(Request $request) {
        if($request->isMethod('get') && $request->has('skip')) {

            $counter = 0;
            $arr3 = array();

            // Extract Prameter
            $skip = $request->input('skip');

            // Get Wrdly Solar World
            $solar = $this->thoughtObject->wrdlySolarSystem($skip);
            if(is_array($solar)) {

                $arr2 = array();
                $solar = json_decode(json_encode($solar),true);
                foreach($solar as $OMG) {
                    $arr1 = array();
                    $arr1['Thought_Id'] = $OMG['Thought_Id'];
                    $arr1['Habitant_Id'] = $OMG['Habitant_Id'];
                    $arr1['Habitant_Name'] = $OMG['Habitant_Name'];
                    $arr1['Theme_Id'] = $OMG['Theme_Id'];
                    $arr1['Heart_Count'] = $OMG['Heart_Count'];
                    $arr1['View_Count'] = $OMG['View_Count'];
                    $arr1['Countribute_Count'] = $OMG['Countribute_Count'];
                    $arr1['Subscribe_Counter'] = $OMG['Subscribe_Counter'];
                    $arr1['Theme_Name'] = $OMG['Theme_Name'];

                    // Get Wrdly Notion Book
                    $book = $this->notionBookObject->getNotionBook($arr1['Thought_Id']);
                    if(is_array($book)) {
                        $arr1['Paragraph'] = $book;
                    } else {
                        $arr1['Paragraph'] = null;
                    }
                    array_push($arr2,$arr1);
                    unset($arr1);
                    $counter++;
                }

                if($counter < 10) {
                   $arr3['Detail'] = $arr3;
                   $arr3['Skip'] = intval($skip);
                   $arr3['End'] = 0;
               } else {
                   $arr3['Detail'] = $arr3;
                   $arr3['Skip'] = intval($skip + 1);
                   $arr3['End'] = 1;
               }
            } else {
                return $this->respondWithMessage("Empty system");
            }
        } else {
            return $this->respondWithError("Not a good api call");
        }
    }

    public function keepSolarSystem(Request $request) {
        if($request->isMethod('get') && $request->has('skip')) {

        }
    }
}
