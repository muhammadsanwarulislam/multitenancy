<?php

declare(strict_types=1);

namespace Repository\User;

use Repository\BaseRepository;
use App\Models\SystemUserProfile;

class ProfileRepository extends BaseRepository
{

    public function model()
    {
        return SystemUserProfile::class;
    }

    public function updateProfileByID($id, array $modelData)
    {
        // Define the fields that should be excluded
        $excludedFields = ['domain'];

        // Filter out excluded fields from the update
        $filteredData = array_filter($modelData, function ($key) use ($excludedFields) {
            return !in_array($key, $excludedFields);
        }, ARRAY_FILTER_USE_KEY);

        // Update the profile
        $this->model()::where('user_id', $id)->update($filteredData);

        // Retrieve the updated user data
        $updatedUser = $this->model()::where('user_id', $id)->first();

        // Return a user resource
        return $updatedUser;
    }
}
