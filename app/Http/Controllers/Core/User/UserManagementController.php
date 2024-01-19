<?php

namespace App\Http\Controllers\Core\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Repository\User\UserRepository;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Http\Controllers\JsonResponseTrait;
use App\Http\Requests\User\UserCreateOrUpdateRequest;

class UserManagementController extends Controller
{
    use JsonResponseTrait;

    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            Gate::authorize('view','users');
            $user = $this->userRepository->getAllUsersWithRole();
            return $this->successJsonResponse('List of users', UserResource::collection($user));
        } catch (\Exception $e) {
            return $this->errorJsonResponse('Error: ' . $e->getMessage());
        }
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(UserCreateOrUpdateRequest $request)
    {
        try {
            Gate::authorize('edit','users');
            $user = $this->userRepository->create($request->validated()+['password' => $this->userRepository->generateDefaultPassword()]);
            return $this->createdJsonResponse('User create successfully',new UserResource($user));
        } catch (\Exception $e) {
            return $this->errorJsonResponse('Error: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            Gate::authorize('view','users');
            $user = $this->userRepository->findByIDWithRole($id);
            return $this->successJsonResponse("The user id is: $id",new UserResource($user));
        } catch (\Exception $e) {
            return $this->errorJsonResponse('Error: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            Gate::authorize('edit','users');
            $user = $this->userRepository->updateByID($id, $request->all());
            return $this->successJsonResponse('User update successfully',$user);
        } catch (\Exception $e) {
            return $this->errorJsonResponse('Error: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Gate::authorize('edit','users');
            $this->userRepository->deletedByID($id);
            return $this->successJsonResponse('User delete successfully');
        } catch (\Exception $e) {
            return $this->errorJsonResponse('Error: ' . $e->getMessage());
        }
    }
}
