<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadRequest;
use App\Models\TemporaryFile;

class UploadController extends Controller
{
    public function upload(UploadRequest $request)
    {
        if($request->has('avatar')) {
            $file = $request->file('avatar');
        }
        if($request->has('image')) {
            $file = $request->file('image');
        }
        $ext = $file->getClientOriginalExtension();
        $folder = uniqid() . '-' . now()->timestamp;
        $filename = uniqid(). '-' . now()->timestamp . '.' . $ext;
        $file->storeAs('public/files/tmp/' . $folder, $filename);

        TemporaryFile::create([
            'folder' => $folder,
            'filename' => $filename
        ]);

        return $folder;
    }
}
