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

    public function findDomainInformations($domain): Model
    {
        return $this->model()::where('domain', $domain)->select('id','domain')->first();
    }

    public function isItValidDomain($domain)
    {
        return $this->model()::whereDomain($domain)->first();
    }
}
