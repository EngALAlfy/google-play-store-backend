<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountStoreRequest;
use App\Http\Requests\AccountUpdateRequest;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AccountController extends Controller
{
    public function index(Request $request): Response
    {
        $accounts = Account::all();
    }

    public function store(AccountStoreRequest $request): Response
    {
        $account = Account::create($request->validated());
    }

    public function show(Request $request, Account $account): Response
    {
        $account = Account::find($id);
    }

    public function update(AccountUpdateRequest $request, Account $account): Response
    {
        $account = Account::find($id);


        $account->update($request->validated());
    }

    public function destroy(Request $request, Account $account): Response
    {
        $account = Account::find($id);

        $account->delete();
    }
}
