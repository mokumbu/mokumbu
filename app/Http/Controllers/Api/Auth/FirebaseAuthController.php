<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Auth as FirebaseAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class FirebaseAuthController extends Controller
{
    public function __invoke(Request $request, FirebaseAuth $firebaseAuth)
    {
        $firebaseToken = $request->bearerToken();

        if (! $firebaseToken) {
            abort(401, 'Token não fornecido');
        }

        try {
            $verifiedToken = $firebaseAuth->verifyIdToken($firebaseToken);
        } catch (\Throwable) {
            abort(401, 'Token inválido');
        }

        $claims = $verifiedToken->claims();

        $uid   = $claims->get('sub');
        $email = $claims->get('email');
        $name  = $claims->get('name') ?? Str::before($email, '@');

        $user = User::updateOrCreate(
            ['firebase_uid' => $uid],
            [
                'email' => $email,
                'name'  => $name,
            ]
        );

        // 🔐 Login WEB (session)
        if (! $request->has('api/*')) {
            $remember = $request->boolean('remember');
            Auth::login($user, $remember);
            return true;
        }

        // 🔑 Login API (token)
        $token = $user->createToken(
            'api',
            abilities: ['*']
        )->plainTextToken;

        return response()->json([
            'token' => $token,
            'user' => [
                'id'    => $user->id,
                'name'  => $user->name,
                'email' => $user->email,
            ],
        ]);
    }
}
