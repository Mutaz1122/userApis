<?php

namespace App\Http\Controllers\Api\V1\user;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\Admin\Users\UserResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Auth\StoreUserRequest;

class UserController extends Controller
{
    public function index(Request $request)
    {
    $users = User::paginate(10);

    return UserResource::collection($users);


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

            $user = User::create($request->all());

            return response()->json([
                'status' => true,
                'user'=> new UserResource($user),
                'message' => 'User Created Successfully',
                // 'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

      
    }
    public function show(User $user)
    {
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        return response()->json(['status' => 'success', 'data' => new UserResource($user)]);


    }
    public function destroy(User $user)
    {
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

        return response()->json(['status' => 'success', 'message' => 'User updated', 'data' => new UserResource($user)]);
    }
}
