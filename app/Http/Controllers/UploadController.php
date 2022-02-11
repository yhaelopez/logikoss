<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadRequest;
use App\Models\TemporaryFile;

class UploadController extends Controller
{
    public function upload(UploadRequest $request)
    {
        $file = $request->file('avatar');
        $filename = $file->getClientOriginalName();
        $folder = uniqid() . '-' . now()->timestamp;
        $file->storeAs('avatars/tmp/' . $folder, $filename);

        TemporaryFile::create([
            'folder' => $folder,
            'filename' => $filename
        ]);

        return $folder;
    }
}
