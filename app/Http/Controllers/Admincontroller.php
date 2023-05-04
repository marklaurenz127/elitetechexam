<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Admins;

use DB;

class Admincontroller extends Controller
{
    public function addAdmin(Request $request){
        $request = $request->all();
        if(empty($request['username'])){
            return response()->json(["status" => false, "msg" => "Username is empty!"]);
        }
        elseif(empty($request['password'])){
            return response()->json(["status" => false, "msg" => "Password is empty!"]);
        }else{
            if (!ctype_alnum($request['username']) || preg_match('/\d/', $request['username'])) {
                return response()->json(['status' => false, 'msg' => "Invalid username!"]);
            } else if(strlen($request['username']) > 10){
                return response()->json(['status' => false, 'msg' => "Username too long!"]);
            } else if(strlen($request['password']) < 10){
                return response()->json(['status' => false, 'msg' => "Password must at least 10 characters long!"]);
            }else{

                $admin = Admins::where('username', $request['username'])->exists();
                if($admin){
                    return response()->json(['status' => false, 'msg' => "Username already used!"]);
                }

                DB::beginTransaction();
                try{

                    Admins::create([
                        "username" => $request['username'],
                        "password" => $request['password']
                    ]);

                    DB::commit();
                    return response()->json(['status' => true, 'msg' => "Added!"]);
                }catch(\Exception | \Error $ex){
                    DB::rollback();
                    return response()->json(['status' => false, 'msg' => "Something went wrong!"]);
                }
            }
        }
    }

    public function removeAdmin(Request $request){
        DB::beginTransaction();
        try{

            Admins::where('username', $request['username'])->delete();

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
