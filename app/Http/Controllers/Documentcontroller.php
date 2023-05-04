<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Crews;
use App\Models\Documents;

use DB;
use Str;

class Documentcontroller extends Controller
{
    public function __construct(){
        date_default_timezone_set("Asia/Manila");
    }


    public function CUdocument(Request $request){
        $request = $request->all();
        $msg = ""; $status = false;
        if(empty($request['code'])){
            $msg = "Code is empty!";
        }
        elseif(empty($request['name'])){
            $msg = "Aame is empty!";
        }
        elseif(empty($request['documentnumber'])){
            $msg = "Document number is empty!";
        }
        elseif(empty($request['dateissued'])){
            $msg = "Date issued is empty!";
        }
        elseif(empty($request['dateexpiry'])){
            $msg = "Date expiry is empty!";
        }
        else{
            $status = true;
        }

        if($status){

            DB::beginTransaction();
            try{

                $msg = "";
                if($request["process"] == "add"){
                    Documents::create([
                        "documentid" => Str::random(10),
                        "crewid" => $request['crewid'],
                        "code" => $request['code'],
                        "name" => $request['name'],
                        "documentnumber" => $request['documentnumber'],
                        "dateissued" => $request['dateissued'],
                        "dateexpiry" => $request['dateexpiry'],
                    ]);
                    $msg = "Added!";
                }else if($request["process"] == "update"){
                    Documents::where('documentid', $request["documentid"])->update([
                        "crewid" => $request['crewid'],
                        "code" => $request['code'],
                        "name" => $request['name'],
                        "documentnumber" => $request['documentnumber'],
                        "dateissued" => $request['dateissued'],
                        "dateexpiry" => $request['dateexpiry'],
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

    public function removeDocument(Request $request){
        DB::beginTransaction();
        try{

            Documents::where('documentid', $request->input('documentid'))->delete();

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
