<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadRequest;
use App\Models\TemporaryFile;

class UploadController extends Controller
{
    public function upload(UploadRequest $request)
    {
        $file = $request->file('avatar');
        $ext = $file->getClientOriginalExtension();
        $folder = uniqid() . '-' . now()->timestamp;
        $filename = uniqid(). '-' . now()->timestamp . '.' . $ext;
        $file->storeAs('public/avatars/tmp/' . $folder, $filename);

        TemporaryFile::create([
            'folder' => $folder,
            'filename' => $filename
        ]);

        return $folder;
    }
}
