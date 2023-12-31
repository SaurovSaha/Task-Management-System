<?php

namespace App\Http\Controllers;

use App\Helper\JWTHelper;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Exception;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Catch_;

class UserController extends Controller
{
    function userRegistation(Request $request){

        try{
            User::create($request->input());
            return response()->json(['status'=>'success', 'message'=>'User registration Successfully']);

        }Catch (Exception $exception){
            return response()->json(['status' =>'failed', 'message' =>$exception->getMessage()]);

        }

    }

    function userLogin(Request $request){

        try{
            $validatedData = $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:6',
            ]);

            $user = User::where('email', $validatedData['email'])->first();

            if($user && Hash::check($validatedData['password'], $user->password)){
                $token = JWTHelper::CreateToken($user->email, $user->id);
                return response()->json(['status' => 'success', 'message' => "Login Successfully"])->cookie('token', $token, time()+60*60);
            } else {
                return response()->json(['status' => 'failed', 'message' => "Invalid credentials"]);
            }
        } catch (Exception $exception){
            return response()->json(['status' =>'failed', 'message' =>$exception->getMessage()]);
        }

    }

    public function update(Request $request) {
        $userID = $request->header('id');
        $userToUpdate = User::find($userID);
    
        if (!$userToUpdate) {
            return response()->json(['error' => 'User not found'], 404);
        }
        $validated = $request->validate([
            'username' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $userToUpdate->update($validated);
    
        return response()->json($userToUpdate);
    }
    


    function userProfile(Request $request){
        $userID= $request->header('id');
        return User::where('id',$userID)->first();
    }

    function userLogout(){
        return Redirect('/Login')->cookie('token','',time()-60*60);
    }
}
