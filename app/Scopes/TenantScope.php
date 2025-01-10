<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use App\Support\TenantManager;  // import the manager

class TenantScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        // Use TenantManager to get the tenant ID
        $tenantId = TenantManager::getTenantId();

        if ($tenantId !== null) {
            // Filter the query by tenant_id
            $builder->where($model->getTable().'.tenant_id', $tenantId);
        }
    }
}
