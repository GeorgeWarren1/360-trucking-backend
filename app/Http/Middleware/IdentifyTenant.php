<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Tenant;
use App\Support\TenantManager;

class IdentifyTenant
{
    public function handle($request, Closure $next)
    {
        // Example: We read tenant UUID from a header
        $tenantUuid = $request->header('X-Tenant-UUID');

        if ($tenantUuid) {
            $tenant = Tenant::where('uuid', $tenantUuid)->first();
            if ($tenant) {
                // BEST PRACTICE: Use TenantManager
                TenantManager::setTenantId($tenant->id);
            }
        }

        return $next($request);
    }
}
