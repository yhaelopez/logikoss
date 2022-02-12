<?php

namespace App\Services;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\TemporaryFile;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function store(StoreUserRequest $request) : User
    {
        $user = User::create([
            'email' => $request->email,
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'email_verified_at' => now()
        ]);

        $user->assignRole($request->roles);

        $temporaryFile = TemporaryFile::whereFolder($request->avatar)->first();

        if($temporaryFile) {
            $user->addMedia(
                storage_path("app/public/files/tmp/$request->avatar/$temporaryFile->filename")
            )->toMediaCollection('media');
            rmdir(storage_path("app/public/files/tmp/$request->avatar"));
            $temporaryFile->delete();
        }

        return $user;
    }

    public function update(UpdateUserRequest $request, User $user) : User
    {
        $data = [
            'email' => $request->email,
            'name' => $request->name,
            'username' => $request->username,
            'email_verified_at' => now()
        ];

        if($request->password) {
            $data += ['password' => Hash::make($request->password)];
        }

        if($request->avatar) {
            $temporaryFile = TemporaryFile::whereFolder($request->avatar)->first();

            if($temporaryFile) {
                $user->addMedia(
                    storage_path("app/public/files/tmp/$request->avatar/$temporaryFile->filename")
                )->toMediaCollection('media');
                rmdir(storage_path("app/public/files/tmp/$request->avatar"));
                $temporaryFile->delete();
            }
        }

        $user->update($data);
        $user->syncRoles($request->roles);

        return $user;
    }
}
