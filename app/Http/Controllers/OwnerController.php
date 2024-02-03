<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OwnerController extends Controller
{
    
    public function index() {
        $users = DB::table('owners')->get();
        return response()->json($users);
    }

}
