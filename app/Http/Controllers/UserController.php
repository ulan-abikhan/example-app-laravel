<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('check')->except(['destroy', 'update']);
    }
    
    public function index() {
        return response()->json(["users"=>"users"]);
    }

    public function show($id) {
        return response()->json(["user_id"=>$id]);
    }

    public function store(Request $request) {
        return response()->json(["user_id"=>"Creating"]);
    }

    public function update(Request $request, $id) {
        return response()->json(["user_id"=>$id]);
    }

    public function destroy($id) {
        return response()->json(["user_id"=>"Deleting $id"]);
    } 


}