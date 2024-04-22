<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class AuthControllerttt extends Controller
{
    use HasApiTokens, HasFactory, Notifiable;

    public function login(Request $request)
{
    if (Auth::attempt($request->only('email', 'password'))) {
        $user = User::where('email', $request->email)->first();

        return response()->json([
            'token' => $user->createToken('auth_token')->plainTextToken,
            'status' => '11',
            'vc_pnome' => $user->vc_pnome,
            'vc_nome_meio' => $user->vc_nome_meio,
            'vc_unome' => $user->vc_unome,
            'img' => $user->img,
            'vc_userName' => $user->vc_userName,
            'telefone' => $user->telefone,
            'ativo' => $user->ativo,
            'email' => $user->email,
            'password' => $user->password,
            'nivel_acesso' => $user->nivel_acesso
        ]);
    } else {
        return response()->json(['message' => 'Not Authorized', 'message_2' => 'Credenciais não encontradas'], 403);
    }
}
    //
    // public function login(Request $request)
    // {
    //     if (Auth::attempt($request->only('email', 'password'))) {
    //         // $token = $request->user()->createToken('invoice')->plainTextToken;
    //         $user=User::where('email',$request->email)->first()->toJson();

    //         // dd($user['vc_pnome']);

    //        // return response()->json(['message' => 'Authorized', 'token' => $request->user()->createToken('auth_token')->plainTextToken,'user'=> $user], 200);

    //         return response()->json([
    //             'token' => $request->user()->createToken('auth_token')->plainTextToken,
    //             'status' => '11',
    //             'vc_pnome' => $user['vc_pnome'],
    //             'vc_nome_meio' => $user['vc_nome_meio'],
    //             'vc_unome' => $user['vc_unome'],
    //             'img' => $user['img'],
    //             'vc_userName' => $user['vc_userName'],
    //             'telefone' => $user['telefone'],
    //             'ativo' => $user['ativo'],
    //             'email' => $user['email'],
    //             'password' => $user['password'],
    //             'nivel_acesso' => $user['nivel_acesso']

    //             ]);
    //     } else {
    //         return response()->json(['message' => 'Not Authorized', 'message_2' => 'Credenciais não encontradas'], 403);

    //     }
    // }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json('Token Revoked', 200);
    }


}
