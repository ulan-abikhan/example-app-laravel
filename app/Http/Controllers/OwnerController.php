<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class OwnerController extends Controller
{
    
    public function index(Request $request) {
        $per_page = $request->per_page ?? 20;
        $results = DB::table('owners')
        ->where('AGE', '>=', 35)
        ->orderBy('AGE')
        ->paginate(
            perPage: $per_page,
            columns: ['id', 'AGE','name', 'surname']
        );

        return response()->json(['owners'=>$results]);
    }

    public function minMax() {
        $result = DB::table('owners')->where('AGE', '!=', '24')->get();

        return response()->json(["count"=>$result]);
    }

    public function store(Request $request) {
        try {
            DB::table('owners')->upsert(
                [
                    "id"=>133,
                    "name"=>$request->name, 
                    "surname"=>$request->surname,
                    "AGE"=>$request->AGE,
                    "address"=>$request->address 
                ],
                "id",
                ["surname", "name", "AGE", "address"]
            );

            return response(status: 201);
        }
        catch (Exception $e) {
            return response()->json(["message"=>$e->getMessage()], 400);
        }

    }

    public function update($id, Request $request) {
        $result = DB::table('owners')
            ->where('id', $id)
            ->update($request->all());

        return response()->json(["affected"=>$result], status: 200);
    }

    public function destroy($id) {
        $result = DB::table('owners')
            ->where('id', $id)
            ->delete();
    }

}