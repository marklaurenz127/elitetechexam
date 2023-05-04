<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Admins;

use DB;

class Authcontroller extends Controller
{
    public function login(Request $request){
        $request = $request->all();

        if(empty($request['username'])){
            return response()->json(['status' => false, 'msg' => "username is empty!"]);
        }else if(empty($request['password'])){
            return response()->json(['status' => false, 'msg' => "password is empty!"]);
        }else{
            $admin = Admins::where('username', $request['username'])->first();
            if(empty($admin)){
                if (!ctype_alnum($request['username']) || preg_match('/\d/', $request['username'])) {
                    return response()->json(['status' => false, 'msg' => "Invalid username!"]);
                } else if(strlen($request['username']) > 10){
                    return response()->json(['status' => false, 'msg' => "Username too long!"]);
                } else if(strlen($request['password']) < 10){
                    return response()->json(['status' => false, 'msg' => "Password must at least 10 characters long!"]);
                }else{
                    DB::beginTransaction();
                    try{
    
                        Admins::create([
                            "username" => $request['username'],
                            "password" => $request['password']
                        ]);

                        DB::commit();
                        session()->put('adminsession', $request['username']);
                        return response()->json(['status' => true]);

                    }catch(\Exception | \Error $ex){
                        DB::rollback();
                        return response()->json(['status' => false, 'msg' => "Something went wrong!"]);
                    }
                }
            }else{
                if($admin->password == $request['password']){
                    session()->put('adminsession', $request['username']);
                    return response()->json(['status' => true]);
                }else{
                    return response()->json(['status' => false, 'msg' => "incorrect password!"]);
                }
            }
        }
    }

    public function logout(){
        session()->flush();
        return redirect('/login');
    }
}
