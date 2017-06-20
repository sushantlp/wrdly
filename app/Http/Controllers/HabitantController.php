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
        if($request->isMethod('post') && $request->has('email') && $request->has('gender') && $request->has('mobile') && $request->has('state') && $request->has('city') && $request->has('address')) {

            // Extract Request Parameter value
            $mobile = $request->input('mobile');
            $state = $request->input('state');
            $city = $request->input('city');
            $address = $request->input('address');
            $latitude = $request->input('latitude');
            $longtitude = $request->input('longtitude');
            $gender = $request->input('gender');
            $email = $request->input('email');


            // Get User Information By Email
            $info = $this->getUserDetailByEmail($email);
            if(is_string($info)) {
                return $info;

            }

            $info = json_decode(json_encode($info),true);
            if(empty($info)) {
                return $this->respondWithError("Invalid user");
            }

            // Update User Detail
            $update = $this->updateUserDetail($info['name'],$mobile,$email);
            if(!is_numeric($update)) {
                return $update;
            }

            // Insert Habitant Complete Information
            $insert = $this->habitantObject->insertHabitantDetail($info['user_id'],$state,$city,$address,$latitude,$longtitude,$gender);
            if(!is_numeric($insert)) {
                return $insert;
            }

            return $this->respondWithSuccess("Successful");

        } else {
            return $this->respondWithError("Not a good api call");
        }

    }
    public function updateProfile(Request $request) {
        if($request->isMethod('post') && $request->has('email') && $request->has('gender') && $request->has('mobile') && $request->has('state') && $request->has('city') && $request->has('address')) {

            // Extract Request Parameter value
            $mobile = $request->input('mobile');
            $state = $request->input('state');
            $city = $request->input('city');
            $address = $request->input('address');
            $latitude = $request->input('latitude');
            $longtitude = $request->input('longtitude');
            $gender = $request->input('gender');
            $email = $request->input('email');


            // Get User Information By Email
            $info = $this->getUserDetailByEmail($email);
            if(is_string($info)) {
                return $info;
            }

            $info = json_decode(json_encode($info),true);
            if(empty($info)) {
                return $this->respondWithError("Invalid user");
            }

            // Update User Detail
            $updateUser = $this->updateUserDetail($info['name'],$mobile,$email);
            if(!is_numeric($updateUser)) {
                return $updateUser;
            }

            // Update Habitant Complete Information
            $updateHabitant = $this->habitantObject->updateHabitantDetail($info['user_id'],$state,$city,$address,$latitude,$longtitude,$gender);
            if(!is_numeric($updateHabitant)) {
                return $updateHabitant;
            }

            return $this->respondWithSuccess("Successful");
        } else {
            return $this->respondWithError("Not a good api call");
        }
    }

    // Request Get Wrdly Static Data
    public function getWrdlyData(Request $request) {
        if($request->isMethod('get')) {

            // Array Variable Declaration
            $arr = array();
            $dayId = 0;

            // Get Indian Time Zone
            date_default_timezone_set("Asia/Kolkata");
            $todayDateTime = new \DateTime();
            $date = $todayDateTime->format('Y-m-d');

            // Convert Date in Numeric Format
            $day = date('D',strtotime($date));

            // Get Wrdly Gender
            $gender = $this->genderObject->wrdlyGender();

            // Get Wrdly Day
            $wrdlyDay = $this->dayObject->wrdlyDay();

            if(is_string($wrdlyDay)) {
                return $wrdlyDay;
            }

            $wrdlyDay = json_decode(json_encode($wrdlyDay),true);
            if(empty($wrdlyDay)) {
                return respondWithMessage("Empty day");
            }

            foreach($wrdlyDay as $DY) {
                if($day == $DY['Day_Name']) {
                    $dayId = $DY['Day_Id'];
                }
            }

            // Get Wrdly Theme
            $theme = $this->themeObject->wrdlyTheme();
            if(is_string($theme)) {
                return $theme;
            }

            // Get Wrdly Depend Upon Day Quote
            $quote = $this->quoteObject->wrdlyDayQuote($dayId);
            if(is_string($quote)) {
                return $quote;
            }

            // Intialization  Variable
            $arr['Gender'] = $gender;
            $arr['Day'] = $wrdlyDay;
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

            if(is_string($solar)) {
                return $solar;
            }

            // Convert Object in Array to Check Empty or not
            $solar = json_decode(json_encode($solar),true);
            if(empty($solar)) {
                return $this->respondWithMessage("Empty system");
            }


            $arr2 = array();
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
                if(is_string($book)) {
                    return $book;
                }

                // Convert Object in Array to Check Empty or not
                $book = json_decode(json_encode($book),true);
                if(empty($book)) {
                    $arr1['Paragraph'] = null;
                } else {
                    $arr1['Paragraph'] = $book;
                }
                array_push($arr2,$arr1);
                unset($arr1);
                $counter++;
            }

            if($counter < 10) {
               $arr3['Detail'] = $arr2;
               $arr3['Skip'] = intval($skip);
               $arr3['End'] = 0;
           } else {
               $arr3['Detail'] = $arr2;
               $arr3['Skip'] = intval($skip + 1);
               $arr3['End'] = 1;
           }

           return $this->respondWithSuccess($arr3);
        } else {
            return $this->respondWithError("Not a good api call");
        }
    }

    // Create Planet
    public function keepSolarSystem(Request $request) {
        if($request->isMethod('post') && $request->has('theme_id') && $request->has('email') && $request->has('paragraph')) {

            // Extract Parameter Value
            $email = $request->input('email');
            $themeId = $request->input('theme_id');
            $paragraph = $request->input('paragraph');

            // Get User Information By Email
            $user = $this->getUserDetailByEmail($email);
            if(is_string($user)) {
                return $user;
            }

            $user = json_decode(json_encode($user),true);
            if(empty($user)) {
                return $this->respondWithError("Invalid user");
            }

            // Get Habitant Information
            $habitant = $this->habitantObject->getHabitantDetail($user['user_id']);
            if(is_string($habitant)) {
                return $habitant;
            }

            $habitant = json_decode(json_encode($habitant),true);
            if(empty($habitant)) {
                return $this->respondWithError("Invalid user");
            }

            // Insert Awesome Ideas
            $insertIdea = $this->thoughtObject->createSolarSystem($habitant['habitant_id'],$themeId);
            if(!is_numeric($insertIdea)) {
                return $insertIdea;
            }

            // Insert Paragraph
            $notionBook = $this->notionBookObject->keepNotionBookParagraph($insertIdea,$habitant['habitant_id'],$paragraph,1);
            if(!is_numeric($notionBook)) {
                return $notionBook;
            }

            return $this->respondWithMessage("Successful");
        } else {
            return $this->respondWithError("Not a good api call");
        }
    }

    // Rquest Insert Keep Book Notion
    public function keepBookNotion(Request $request) {
        if($request->isMethod('post') && $request->has('email') && $request->has('thought_id') && $request->has('paragraph')) {

            // Extract Parameter Value
            $thoughtId = $request->input('thought_id');
            $paragraph = $request->input('paragraph');
            $email = $request->input('email');

            // Get User Information By Email
            $user = $this->getUserDetailByEmail($email);
            if(is_string($user)) {
                return $user;
            }

            $user = json_decode(json_encode($user),true);
            if(empty($user)) {
                return $this->respondWithError("Invalid user");
            }

            // Get Habitant Information
            $habitant = $this->habitantObject->getHabitantDetail($user['user_id']);
            if(is_string($habitant)) {
                return $habitant;
            }

            $habitant = json_decode(json_encode($habitant),true);
            if(empty($habitant)) {
                return $this->respondWithError("Invalid user");
            }

            // Get Book Owner
            $owner = $this->thoughtObject->getBookOwner($thoughtId);
            if(is_string($owner)) {
                return $owner;
            }

            if(empty($owner)) {
                return $this->respondWithMessage("Invalid user");
            }


            // Check Whether Helper User or Book Owner Same
            if($habitant['habitant_id'] == $owner['habitant_id']) {

                // Insert Paragraph
                $notionBook = $this->notionBookObject->keepNotionBookParagraph($thoughtId,$habitant['habitant_id'],$paragraph,1);
                if(!is_numeric($notionBook)) {
                    return $notionBook;
                }
            } else {

                // Insert Paragraph
                $notionBook = $this->notionBookObject->keepNotionBookParagraph($thoughtId,$habitant['habitant_id'],$paragraph,0);
                if(!is_numeric($notionBook)) {
                    return $notionBook;
                }
            }

            return $this->respondWithMessage("Successful");

        } else {
            return $this->respondWithError("Not a good api call");
        }
    }
}
