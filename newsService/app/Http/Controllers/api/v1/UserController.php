<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiRequest;
use App\Models\User;

class UserController extends Controller
{
    public function index() {
        return User::all();
    }

    public function show(User $user) {
        return $user;
    }

}
