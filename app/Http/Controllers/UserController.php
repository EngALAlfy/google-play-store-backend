<?php

namespace App\Http\Controllers;

use App\Events\NewUserRegistered;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function index(Request $request): Response
    {
        $users = User::all();
    }

    public function store(UserStoreRequest $request): Response
    {
        $user = User::create($request->validated());

        NewUserRegistered::dispatch($user);
    }

    public function show(Request $request, User $user): Response
    {
        $user = User::find($id);
    }

    public function update(UserUpdateRequest $request, User $user): Response
    {
        $user = User::find($id);


        $user->update($request->validated());
    }

    public function destroy(Request $request, User $user): Response
    {
        $user = User::find($id);

        $user->delete();
    }
}
