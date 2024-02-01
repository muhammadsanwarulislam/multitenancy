<?php

namespace Repository\Permission;
use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Repository\BaseRepository;

class PermissionRepository extends BaseRepository {
    public function model()
    {
        return Permission::class;
    }

    function getAllPermissionsForSeeder()
    {
        return $this->model()::all();
    }
}
