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
        // if (isset($request->start_age)) {
        //     $results = $results->where('AGE', '>=', $request->start_age);
        // }
        
        // if (isset($request->end_age)) {
        //     $results = $results->where('AGE', '<=', $request->end_age);
        // }

        // if (isset($request->search)) {
        //     $search = $request->search;
        //     $results = $results->where(function($query) use ($search) {
        //         $query->where('name', 'LIKE', "$search%")
        //             ->orWhere('surname', 'LIKE', "$search%");
        //     });
        // }

        // $results = $results->get();
    } 


}