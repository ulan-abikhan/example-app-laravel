<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\table;

class OwnerController extends Controller
{
    
    public function index(Request $request) {
        
        $results = DB::table('owners')->whereNot('AGE', '<=', 34)->get();

        $owners = DB::table('owners')->where('AGE', '>', 34)->get();

        return $results;
    }

    public function minMax() {
        $result = DB::table('owners')->where('AGE', '!=', '24')->get();

        return response()->json(["count"=>$result]);
    }

    public function store(Request $request) {
        DB::insert("INSERT INTO owners (id, name, surname, AGE, address, created_at) 
        VALUES (?, ?, ?, ?, ?, ?)", 
        [null, $request->name, $request->surname, $request->age, $request->address, null]);
    }
    
}