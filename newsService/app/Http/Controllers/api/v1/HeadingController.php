<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Heading;
use App\Models\User;
use App\Utils\JsonToXmlDecoder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

//use App\Models\Heading;
class HeadingController extends Controller
{
    public function index(Request $request) {
        $offset = $request['offset'];
        $limit = $request['limit'];
        if(str_contains($request->header('format'), 'xml')) {
            $decoder = new JsonToXmlDecoder;
            return $decoder->generateValidXmlFromObj(Heading::all()
                ->skip($offset)
                ->take($limit));
        }
        return Heading::all()
            ->skip($offset)
            ->take($limit);
    }

    public function store(Request $request) {
        $rules = array(
            'name' => 'required'
        );
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()) {
            return response('Not valid data', 400);
        }
        Heading::create($request->post());
        return response('OK', 200);
    }

    public function show(Request $request, $id) {
        $heading = Heading::find($id);
        if(!$heading) {
            return response('Heading not found', 404);
        }
        if(str_contains($request->header('format'), 'xml')) {
            $decoder = new JsonToXmlDecoder;
            return $decoder->generateValidXmlFromObj($heading);
        }
        return $heading;
    }

    public function users(Request $request, $id) {
        $offset = $request['offset'];
        $limit = $request['limit'];
        $rs = '';
        $heading = Heading::find($id);
        if(str_contains($request->header('format'), 'xml')) {
            $decoder = new JsonToXmlDecoder;
            return $decoder->generateValidXmlFromObj($heading);
        }
        return $heading->users
            ->skip($offset)
            ->take($limit);
    }
}
