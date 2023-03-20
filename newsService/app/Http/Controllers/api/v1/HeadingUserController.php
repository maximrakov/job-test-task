<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\HeadingUser;
use Illuminate\Http\Request;

class HeadingUserController extends Controller
{
    public function index(Request $request) {
        $offset = $request['offset'];
        $limit = $request['limit'];
        return HeadingUser::all()
            ->skip($offset)
            ->take($limit);
    }

    public function store(Request $request) {
        $heading_user = new HeadingUser;
        $heading_user->heading_id = $request['heading_id'];
        $heading_user->user_id = $request['user_id'];
        $heading_user->save();
    }

    public function delete(Request $request) {
        HeadingUser::where('user_id', $request['user_id'])
            ->where('heading_id', $request['heading_id'])->delete();
    }

    public function delete_all(Request $request) {
        HeadingUser::where('user_id', $request['user_id'])->delete();
    }

    public function destroy(HeadingUser $headingUser) {
        HeadingUser::where('heading_id', $headingUser['heading_id'])->delete();
    }
}
