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
    public function index(Request $request)
    {
        $offset         = $request['offset'];
        $limit          = $request['limit'];
        $option         = $request['option'];
        $searchData     = $request['searchData'];
        $searchColumn   = $request['searchColumn'];

        try {
            $tenantModel = $this->tenantRepository->getAll($offset, $limit, $searchData, $searchColumn, $option);
            $totalCount = sizeof($tenantModel);

            return $this->successJsonResponseWithLimitOffset('List of tenants',$option, $offset, $limit, $totalCount,['tenant' => $tenantModel]);
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
            
            return $this->createdJsonResponse('Create successfully', [
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
