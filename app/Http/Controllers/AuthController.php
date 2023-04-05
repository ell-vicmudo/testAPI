<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Traits\HttpResponses;
use App\Http\Requests\StoreUserRequest;


class AuthController extends Controller
{

use HttpResponses;

public function register(StoreUserRequest $request)
{
    $request->validated($request->all());

    $user = User::create([
                   'employee_number' => $request->employee_number,
                   'name' => $request->name,
                   'email' => $request->email,
                   'role' => $request->role,
                   'password' => Hash::make($request->password),
       ]);


    $token = $user->createToken('Access token for '.$user->name)->plainTextToken;

return $this->success([
        'status' => 'Success',
        'user' => $user,
        'token' => $token
]);
}

public function login(Request $request)
{
if (!Auth::attempt($request->only('email', 'password'))) {
return $this->error(
'','Invalid login details'
           , 401);
       }

$user = User::where('email', $request['email'])->firstOrFail();

$token = $user->createToken('auth_token')->plainTextToken;

return $this->success([
           'status' => 'Success',
           'access_token' => $token,
           'token_type' => 'Bearer',
]);
}


public function logout()
{
    $user = Auth::user();
    $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
    
    
        return $this->success(
            '', null, 204
        );
    
}

}
