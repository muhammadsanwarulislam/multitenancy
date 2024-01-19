<?php

declare(strict_types=1);

namespace Repository\Tenant;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Model;
use Repository\BaseRepository;

class TenantManagementRepository extends BaseRepository
{
    public function model()
    {
        return Tenant::class;
    }

    public function findTenantByDomain($domain): Model
    {
        return $this->model()::where('domain', $domain)->first();
    }
}
