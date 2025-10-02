<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function register(Request $request)
    {
      $validate = $request->validate([
        'name'  => 'required',
        'email' => 'required|email|unique:users',
        'password'  => 'required',
        'password_confirmation' => 'required|same:password',
        
    ]);

    $validate['password'] = bcrypt($request->password);

    $user = User::create($validate);
    if($user){
            $data['Success'] = true;
            $data['Message'] = "User Berhasil Disimpan";
            $data['Data'] = $user;
            $data['token'] = $user->createToken('api_token') ->plainTextToken;
            return response()->json($data, Response::HTTP_CREATED);//201 biar berhasil (kodenya)

        }else{
            $data['Success'] = false;
            $data['Message'] = "User Gagal Disimpan";
            return response()->json($data, Response::HTTP_BAD_REQUEST);//400 biar gagal (kodenya)
        }
        
    
 
    }

public function login(Request $request)
{
    if(Auth::attempt([
        'email' => $request->email,
        'password' => $request->password
    ])) {
        $user = Auth::user();
        $success['token'] = $user->createToken('api_token')->plainTextToken;
        $success['name'] = $user->name;
        return response()->json($success, 201);
    } else {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

}

}
