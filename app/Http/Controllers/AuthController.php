<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class AuthController extends Controller
{
    public function register(Request $request, User $user)
    {
        $this->validate($request, [
            'name'          => 'required',
            'email'         => 'required|email|unique:users',
            'password'      => 'required|min:6',
            'address'       => 'present',
            'phone'         => 'present',
        ]);

        $user = $user->create([
                    'name'      => $request->name,
                    'email'     => $request->email,
                    'password'  => hash('sha256', $request->password),
                    'address'   => $request->address,
                    'phone'     => $request->phone,
                    'api_token' => hash('sha256', $request->email)
                ]);

        $data   = fractal()
                ->item($user)
                ->transformWith(new UserTransformer)
                ->addMeta([
                    'token' => $user->api_token,
                ])
                ->toArray();

        return response()->json($data, 201);
    }

    public function login(Request $request, User $user)
    {
        $password   = hash('sha256', $request->password);

        if ($user->where('email', $request->email)->count() === 0) {
            return response()->json(['error' => 'User not found'], 200);
        }

        if ($user->where('email', $request->email)->where('password', $password)->count() === 0) {
            return response()->json(['error' => 'Your credential didn\'t match']);
        }

        $user   = $user->where('email', $request->email)->where('password', $password)->first();

        return fractal()
            ->item($user)
            ->transformWith(new UserTransformer)
            ->addMeta([
                'ApiToken'  => $user->api_token,
                'Secret-Key' => hash('sha512', $user->name . $user->email),
            ])
            ->toArray();
    }
}
