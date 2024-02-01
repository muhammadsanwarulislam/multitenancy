<?php

declare(strict_types=1);

namespace Repository\File;

use App\Models\SystemFile;
use Repository\BaseRepository;
use App\Models\SystemUserProfile;

class FileUploadRepository extends BaseRepository
{
    public function model()
    {
        return SystemFile::class;
    }

    public function processFile($attachment, $filePath)
    {
        $systemFile = new SystemFile([
            'model_type' => SystemUserProfile::class,
            'model_id' => auth()->user()['id'],
            'file_type' => 'attachment',
            'file_path' => $filePath,
            'original_name' => $attachment->getClientOriginalName(),
            'mime_type' => $attachment->getClientMimeType(),
        ]);

        $systemFile->save();
    }

    // Generate folder and file names based on the current datetime
    public function generateFolderInPublicStorage()
    {
        return now()->format('Y-m-d');
    }

    // Generate file name based on the current datetime and the original file name
    public function generateFileName($attachment)
    {
        return now()->format('His') . '_' . $attachment->getClientOriginalName();
    }
}
