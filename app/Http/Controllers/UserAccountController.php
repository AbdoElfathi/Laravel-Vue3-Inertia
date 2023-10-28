<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\Request as ClientRequest;

class UserAccountController extends Controller
{
    public function create()
    {
        return inertia('UserAccount/Create');
    }

    public function store(ClientRequest $request)
    {

    }
}
