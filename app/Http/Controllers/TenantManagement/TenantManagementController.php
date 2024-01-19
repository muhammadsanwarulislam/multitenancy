<?php

namespace App\Http\Controllers\TenantManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\JsonResponseTrait;
use Repository\Tenant\TenantManagementRepository;

class TenantManagementController extends Controller
{
    use JsonResponseTrait;

    protected $tenantRepository;

    function __construct(TenantManagementRepository $tenantRepository)
    {
        $this->tenantRepository =  $tenantRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $tenantModel = $this->tenantRepository->getAll();
            return $this->json('List of tenants',['tenant' => $tenantModel]);
        } catch (\Exception $e) {
            return $this->error('Error: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $tenantModel = $this->tenantRepository->create($request->all());
            return $this->json('Create successfully', [
                'tenant' => $tenantModel,
            ]);
        } catch (\Exception $e) {
            return $this->error('Error: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
