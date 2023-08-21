<?php

namespace App\Http\Controllers\user;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\StoreUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
// resource user laravel

    public function index()
    {
        // not all users 
        $users = User::all();
        return response()->json($users);


    }



    public function store(StoreUserRequest $request)
    {
        
           

          

            if($request->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $request->errors()
                ], 401);
            }

            // create a user 
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            return response()->json([
                'status' => true,
                'user'=> $user,
                'message' => 'User Created Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

      
    }


// resource user
    public function show(User $user)
    {
        // $user = User::find($id);
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        return response()->json(['status' => 'success', 'data' => $user]);

       
    }




    public function destroy(User $user)
    {
        // $user = User::find($user);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $user->delete();

        return response()->json(['status' => 'success', 'message' => 'User deleted']);
    }





    public function update(Request $request, User $user)
    {
        $user = User::find($user);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'email' => 'email'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password'=>$request->password,
            'updated_at' => now()
        ]);

        return response()->json(['status' => 'success', 'message' => 'User updated', 'data' => $user]);
    }
}
