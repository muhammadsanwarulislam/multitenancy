<?php

declare(strict_types=1);

namespace App\Http\Controllers\Core\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Repository\User\UserRepository;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Http\Controllers\JsonResponseTrait;
use App\Http\Requests\User\UserCreateOrUpdateRequest;
use Illuminate\Support\Facades\DB;
use Repository\User\ProfileRepository;

class UserManagementController extends Controller
{
    use JsonResponseTrait;

    protected $userRepository;
    protected $profileRepository;

    public function __construct(UserRepository $userRepository, ProfileRepository $profileRepository)
    {
        $this->userRepository       =   $userRepository;
        $this->profileRepository    =   $profileRepository;
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
        
        try {
            Gate::authorize('view', 'users');
            $users = $this->userRepository->getAll($offset, $limit, $searchData, $option);
            $totalCount = $users['count'];
            return $this->successJsonResponseWithLimitOffset('List of users', $option, $offset, $limit, $totalCount, UserResource::collection($users['result']));
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
            DB::beginTransaction();
            Gate::authorize('edit', 'users');
            $user = $this->userRepository->create($request->validated() + ['password' => $this->userRepository->generateDefaultPassword()]);
            // Associate the user ID with the profile
            $this->profileRepository->create([
                'user_id' => $user['id'],
            ]);
            DB::commit();

            return $this->createdJsonResponse('User create successfully', new UserResource($user));
        } catch (\Exception $e) {
            DB::rollBack();

            return $this->errorJsonResponse('Error: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            Gate::authorize('view', 'users');
            $user = $this->userRepository->findByIDWithRole($id);
            return $this->successJsonResponse("The user id is: $id", new UserResource($user));
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
            Gate::authorize('edit', 'users');
            $user = $this->userRepository->updateByID($id, $request->all());
            return $this->successJsonResponse('User update successfully', $user);
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
            Gate::authorize('edit', 'users');
            $this->userRepository->deletedByID($id);
            return $this->successJsonResponse('User delete successfully');
        } catch (\Exception $e) {
            return $this->errorJsonResponse('Error: ' . $e->getMessage());
        }
    }
}
