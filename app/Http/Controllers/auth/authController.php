<?php
namespace App\Http\Controllers\auth;
use App\Models\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\StoreUserRequest;
use Illuminate\Support\Facades\Validator;

// validation format , validation length and type, family request 
class authController extends Controller
{

    // register and create user controller 
    public function register(StoreUserRequest $request)
    {
         
          

            // if($request->failed()){
            //     return response()->json([
            //         'status' => false,
            //         'message' => 'validation error',
            //         'errors' => $request->errors()
            //     ], 422);
            // }

            // create a user 
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

      
    }


        // login conroller
    public function login(LoginRequest $request)
    {
        // if($request->all()){
        //         return response()->json([
        //             'status' => false,
        //             'message' => 'validation error',
        //             'errors' => $request->errors()
        //         ], 422);
        //     }



                    // check if the user data is valid or not
            if (auth()->attempt(['email' =>$request-> email, 'password' =>$request-> password])) {
                $user = User::where('email', $request->email)->first();

                return response()->json([
                    'status' => true,
                    'message' => 'User Logged In Successfully',
                    'token' => $user->createToken("API TOKEN")->plainTextToken
                ], 200);

            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Email or Password is not correct.',
                ], 401);
            }
           

   
    }
}


    
