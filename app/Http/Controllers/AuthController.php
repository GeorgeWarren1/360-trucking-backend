<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'tenant_uuid' => 'required|exists:tenants,uuid',
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ]);

        $tenant = Tenant::where('uuid', $request->tenant_uuid)->firstOrFail();

        $user = User::create([
            'tenant_id' => $tenant->id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'user',
        ]);

        return response()->json(['message' => 'User registered successfully'], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'tenant_uuid' => 'required|exists:tenants,uuid',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $tenant = Tenant::where('uuid', $request->tenant_uuid)->firstOrFail();
        $user = User::where('email', $request->email)
                    ->where('tenant_id', $tenant->id)
                    ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $tokenScopes = $user->role === 'admin' ? ['admin'] : ['user'];
        $token = $user->createToken('API Token', $tokenScopes)->accessToken;

        return response()->json(['token' => $token], 200);
    }

    public function profile(Request $request)
    {
        return response()->json($request->user());
    }
}
