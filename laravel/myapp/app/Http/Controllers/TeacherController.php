<?php

namespace App\Http\Controllers;

use App\Exceptions\NotFound;
use Exception;
use App\Models\School\Level;
use Illuminate\Http\Request;
use App\Models\School\Subject;
use App\Models\School\Teacher;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teacher=Teacher::all();

        return response()->json([
            'status'=>true,
            'message'=>'fetch all',
            'data'=>$teacher,
        ],201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $teacher=Teacher::create($request->all());

        return response()->json([
            'status'=>true,
            'message'=>'created',
            'data'=>$teacher,
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $teacher=Teacher::find($id);

        // $teacher=Teacher::find(3);
        // $subject=$teacher->subjects;
        // return $subject;

        // $subject=Subject::find(2);
        // $teacher=$subject->teacher;
        // return $teacher;

        // $teacher=Teacher::find(3);
        // $level=$teacher->levels;
        // return $level;

        // $teacher=Teacher::find(3);
        // $teacher->levels()->sync([1]);

        return Level::whereHas('teachers')->get();

        // $level=Level::find(1);
        // $teacher=$level->teachers;
        // return $teacher;

        // return response()->json([
        //     'status'=>true,
        //     'message'=>'show one',
        //     'data'=>$teacher,
        // ],201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $teacher=Teacher::find($id);
        } catch (\Exception $ex) {
            throw new NotFound();//this is our exception class 
            // throw new Exception("Error Processing Request", 1);

        }
        $teacher->update($request->all());

        return response()->json([
            'status'=>true,
            'message'=>'updated',
            'data'=>$teacher,
        ],201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $teacher=Teacher::find($id);
        $teacher->delete();

        return response()->json([
            'status'=>true,
            'message'=>'deleted',
            'data'=>$teacher,
        ],201);
    }

    public function teacherWithLevel()
    {
        // $tea_id=[];
        // $lev_id=[];
        // $tea=Teacher::all();
        // foreach ($tea as $key => $value) {
        //     array_push($tea_id,$value->id);
        // }
        // $lev=Level::all();
        // foreach ($lev as $key => $value) {
        //     array_push($lev_id,$value->id);
        //     $leve=Level::find($value->id);
        //     $leve->subjects()->sync($lev_id);

        // }

        $teacher=Teacher::find(3);
        $teacher->levels()->sync([1]);
        return Level::with('subjects')->get();
    }


}
