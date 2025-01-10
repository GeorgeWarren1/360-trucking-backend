<?php

namespace App\Support;

class TenantManager
{
    /**
     * We'll store the tenant ID as a static property so each request
     * can set it and retrieve it throughout the request lifecycle.
     */
    protected static ?int $tenantId = null;

    /**
     * Set the current tenant's ID.
     */
    public static function setTenantId(int $tenantId): void
    {
        self::$tenantId = $tenantId;
    }

    /**
     * Get the current tenant's ID.
     */
    public static function getTenantId(): ?int
    {
        return self::$tenantId;
    }

    /**
     * Check if the current tenant ID is set.
     */
    public static function hasTenant(): bool
    {
        return self::$tenantId !== null;
    }
}
