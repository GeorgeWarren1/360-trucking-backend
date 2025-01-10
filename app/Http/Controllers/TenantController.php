<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    public function store(Request $request)
    {
        // Validate incoming data
        $request->validate([
            'name' => 'required',
            'uuid' => 'required|unique:tenants,uuid',
        ]);

        // Create the tenant
        $tenant = Tenant::create([
            'name' => $request->input('name'),
            'uuid' => $request->input('uuid'),
        ]);

        return response()->json([
            'message' => 'Tenant created successfully.',
            'data' => $tenant
        ], 201);
    }
}
