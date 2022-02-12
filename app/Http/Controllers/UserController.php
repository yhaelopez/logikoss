<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\UserService;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->authorizeResource(User::class);
        $this->userService = $userService;
    }

    public function index()
    {
        $users = User::with(['roles'])->where('id', '>', 1)->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::get();
        return view('users.create', compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {

        $user = $this->userService->store($request);
        return redirect()->route('users.index')->withSuccess(__('user.store.success', ['user' => $user->username]));
    }

    public function show(User $user)
    {
        $roles = Role::get();
        return view('users.show', compact('user', 'roles'));
    }

    public function edit(User $user)
    {
        $roles = Role::get();
        $user->load('roles');
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user = $this->userService->update($request, $user);
        return redirect()->route('users.index')->withSuccess(__('user.update.success', ['user' => $user->username]));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->withSuccess(__('user.delete.success', ['user' => $user->username]));
    }

}
