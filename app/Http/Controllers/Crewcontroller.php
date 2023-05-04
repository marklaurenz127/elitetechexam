<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Crews;
use App\Models\Documents;

use DB;
use Str;

class Crewcontroller extends Controller
{
    public function __construct(){
        date_default_timezone_set("Asia/Manila");
    }

    public function CUcrew(Request $request){
        $msg = ""; $status = false;
        if(empty($request['firstname'])){
            $msg = "First name is empty";
        }
        elseif(empty($request['middlename'])){
            $msg = "Middle name is empty";
        }
        elseif(empty($request['lastname'])){
            $msg = "Last name is empty";
        }
        elseif(empty($request['email'])){
            $msg = "Email name is empty";
        }
        elseif(empty($request['address'])){
            $msg = "Address is empty";
        }
        elseif(empty($request['education'])){
            $msg = "Education is empty";
        }
        elseif(empty($request['contactnumber'])){
            $msg = "Contact number is empty";
        }
        else{
            $status = true;
        }

        if($status){

            DB::beginTransaction();
            try{

                $msg = "";
                if($request['process'] == "add"){
                    Crews::create([
                        "crewid" => Str::random(10),
                        "firstname" => $request['firstname'],
                        "middlename" => $request['middlename'],
                        "lastname" => $request['lastname'],
                        "email" => $request['email'],
                        "address" => $request['address'],
                        "education" => $request['education'],
                        "contactnumber" => $request['contactnumber'],
                    ]);
                    $msg = "Added!";
                } else if($request['process'] == "update"){
                    Crews::where('crewid', $request['crewid'])->update([
                        "firstname" => $request['firstname'],
                        "middlename" => $request['middlename'],
                        "lastname" => $request['lastname'],
                        "email" => $request['email'],
                        "address" => $request['address'],
                        "education" => $request['education'],
                        "contactnumber" => $request['contactnumber'],
                    ]);
                    $msg = "Updated!";
                }

                DB::commit();
                return response()->json([
                    "status" => true,
                    "msg" => $msg
                ]);

            }catch(\Exception | \Error $ex){
                DB::rollback();
                return $ex;
                return response()->json([
                    "status" => false,
                    "msg" => "Something went wrong!"
                ]);
            }

        }else{
            return response()->json([
                "status" => false,
                "msg" => $msg
            ]);
        }
    }


    public function removeCrew(Request $request){
        DB::beginTransaction();
        try{

            Crews::where('crewid', $request['crewid'])->delete();

            DB::commit();
            return response()->json([
                "status" => true,
                "msg" => "Deleted!"
            ]);

        }catch(\Exception | \Error $ex){
            DB::rollback();
            return response()->json([
                "status" => false,
                "msg" => "Something went wrong!"
            ]);
        }
    }
}
