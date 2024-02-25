<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;

class SchoolContoller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schools = School::all();
        return response()->json(["schools"=>$schools]);
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $school = new School();
        
    //     if ($request->number <= 0) {
    //         $school->number = null;
    //     }
    //     else {
    //         $school->number = $request->number;
    //     }

    //     $school->name = $request->name;

    //     $school->save();

    //     $school->refresh();

    //     return response()->json($school, 201);
    // }

    public function store(Request $request)
    {
        $school = School::create([
            "name"=>$request->name,
            "number"=>$request->number,
            "bin"=>$request['bin'] ?? "010101010101"
        ]);

        $school->refresh();

        return response()->json($school, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $school = School::find($id);

        return response()->json($school);
    }

    public function conditionalIndex() {
        $schools = School::whereNotNull('number')->get();

        return response()->json(["schools"=> $schools]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $school = School::find($id);

        if ($request['name'] != null) {
            $school->name = $request['name'];
        }
        if ($request->has('number')) {
            $school->number = $request['number'];
        }
        if ($request['bin'] != null) {
            $school->bin = $request['bin'];
        }

        $school->save();

        return $school->wasChanged();

        // $school->refresh();

    }

    // public function update(Request $request, $id)
    // {
    //     $school = School::find($id);

    //     School::where('id', $id)->update([
    //         'number'=> $request->has('number') ? $request['number'] : $school->number,
    //         'name'=>$request['name'] ?? $school->name,
    //         'bin'=>$request['bin'] ?? $school->bin
    //     ]);

    //     return response(status: 204);
    // }

    public function isD($school) {
        
        $message = $school->isDirty() ? "School with id=$school->id is dirty" : 
        "School with id=$school->id is not dirty";

        return response()->json($message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $school_was_deleted = School::find($id)->delete();

        return response()->json(["Deleted"=>$school_was_deleted]);
    }

    public function destroyMany(Request $request) {
        $deletingIds = explode(',', $request->id);
        
        $count = School::destroy($deletingIds);

        return response()->json(["Deleted elements count"=>$count]);
    }
}