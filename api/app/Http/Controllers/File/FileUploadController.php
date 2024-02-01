<?php

namespace App\Http\Controllers\File;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Repository\File\FileUploadRepository;
use App\Http\Controllers\JsonResponseTrait;
use App\Http\Requests\File\FileUploadRequest;

class FileUploadController extends Controller
{
    use JsonResponseTrait;

    protected $userRepository;
    protected $profileRepository;
    protected $fileUploadRepository;

    public function __construct(FileUploadRepository $fileUploadRepository)
    {

        $this->fileUploadRepository =   $fileUploadRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
    public function store(FileUploadRequest $request)
    {
        try {
            $attachment = $request->file('attachment');

            // Additional validation for image files (optional)
            if ($attachment->getMimeType() && strpos($attachment->getMimeType(), 'image') === false) {
                return $this->errorJsonResponse('The file must be an image (jpeg, png, jpg, gif)');
            }

            // Generate folder and file names based on the current datetime
            $currentDateTime = now();
            $folderName = $currentDateTime->format('Y-m-d');
            $fileName = $currentDateTime->format('His') . '_' . $attachment->getClientOriginalName();

            // Move the file to the public/folder/file directory with a unique filename
            $attachment->move(public_path($request['domain']."/{$folderName}"), $fileName);

            // Create a new SystemFile record
            $systemFile = $this->fileUploadRepository->processFile($attachment, $request['domain']."/{$folderName}/{$fileName}");

            return $this->createdJsonResponse('File uploaded successfully', $systemFile);
        } catch (\Exception $e) {
            return $this->errorJsonResponse('Error: ' . $e->getMessage());
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
