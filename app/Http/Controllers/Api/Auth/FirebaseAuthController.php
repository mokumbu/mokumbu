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

        $uid        = $claims->get('sub');
        $email      = $claims->get('email');
        $name       = $claims->get('name');
        $picture    = $claims->get('picture');
        $provider   = $claims->get('firebase')['sign_in_provider'];

        // 1️⃣ Verifica se social account já existe
        $socialAccount = \App\Models\UserSocialAccount::where([
            'provider' => $provider,
            'provider_uid' => $uid,
        ])->first();

        if ($socialAccount) {
            $user = $socialAccount->user;
        } else {

            // 2️⃣ Verifica se já existe usuário com mesmo email
            $user = User::where('email', $email)->first();

            if (! $user) {
                $user = User::create([
                    'name'     => $name,
                    'email'    => $email,
                    'username' => $this->generateUniqueUsername($name),
                    'email_verified_at' => now(),
                ]);

                $user->profile()->create([
                    'id' => Str::uuid(),
                    'profile_picture' => $picture,
                ]);
            }

            // 3️⃣ Cria vínculo social
            $user->socialAccounts()->create([
                'provider' => $provider,
                'provider_uid' => $uid,
                'provider_email' => $email,
            ]);
        }

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

    private function generateUniqueUsername(string $name): string
    {
        $base = Str::slug($name, '');
        $username = $base;
        $counter = 1;

        while (User::where('username', $username)->exists()) {
            $username = $base . $counter;
            $counter++;
        }

        return $username;
    }
}
