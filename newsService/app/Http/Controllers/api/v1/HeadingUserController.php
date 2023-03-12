<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\HeadingUser;
use Illuminate\Http\Request;

class HeadingUserController extends Controller
{
    public function index() {
        return HeadingUser::all();
    }
    public function store(Request $request) {
        $heading_user = new HeadingUser();
        $heading_user->user_id = $request['user_id'];
        $heading_user->heading_id = $request['heading_id'];
        $heading_user->save();
    }
}
