<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\TemporaryFile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create([
            'email' => $request->email,
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'email_verified_at' => now()
        ]);

        $temporaryFile = TemporaryFile::whereFolder($request->avatar)->first();

        if($temporaryFile) {
            $user->addMedia(
                storage_path("app/public/avatars/tmp/$request->avatar/$temporaryFile->filename")
            )->toMediaCollection('public');
            rmdir(storage_path("app/public/avatars/tmp/$request->avatar"));
            $temporaryFile->delete();
        }

        return redirect()->route('users.index')->withSuccess(__('user.store.success', ['user' => $user->username]));
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user)
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
                    storage_path("app/public/avatars/tmp/$request->avatar/$temporaryFile->filename")
                )->toMediaCollection('public');
                rmdir(storage_path("app/public/avatars/tmp/$request->avatar"));
                $temporaryFile->delete();
            }
        }


        $user->update($data);
        return redirect()->route('users.index')->withSuccess(__('user.update.success', ['user' => $user->username]));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->withSuccess(__('user.delete.success', ['user' => $user->username]));
    }
}
