<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Heading;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bootstrap\HandleExceptions;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function index(Request $request) {
        $limit = $request['limit'];
        $offset = $request['offset'];
        return User::all()
            ->skip($offset)
            ->take($limit);
    }

    public function show($id) {
        $user = User::find($id);
        if(!$user) {
            return response('User not found', 404);
        }
        return $user;
    }

    public function store(Request $request) {
        $rules = array(
            'name' => 'required',
            'email' => 'email | required',
            'password' => 'required'
        );
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return response('Not valid data', 400);
        }
        Heading::create($request->post());
        return response('OK', 201);
    }

    public function headings(Request $request, $id) {
        $limit = $request['limit'];
        $offset = $request['offset'];
        $user = User::find($id);
        return $user->headings
            ->skip($offset)
            ->take($limit);
    }
}
