<?php
namespace App\Http\Controllers\Api\V1\auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\StoreUserRequest;

class authController extends Controller
{
    public function register(StoreUserRequest $request)
    { 
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


    public function login(LoginRequest $request)
    {
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


    
