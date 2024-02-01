<?php

declare(strict_types=1);

namespace App\Http\Controllers\Core\Profile;

use Illuminate\Http\Request;
use Repository\User\UserRepository;
use App\Http\Controllers\Controller;
use Repository\User\ProfileRepository;
use App\Http\Controllers\JsonResponseTrait;
use App\Http\Requests\User\UserProfileUpdateRequest;

class ProfileController extends Controller
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
    public function update(UserProfileUpdateRequest $request, string $id)
    {
        try {
            $user = $this->profileRepository->updateProfileByID($id, $request->all());

            return $this->createdJsonResponse('Profile updated successfully', $user);
        } catch (\Exception $e) {
            return $this->errorJsonResponse('Error: ' . $e->getMessage());
        }
    }

}
