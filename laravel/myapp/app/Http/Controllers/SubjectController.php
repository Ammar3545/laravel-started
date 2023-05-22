<?php

namespace App\Http\Controllers;

use App\Models\School\Subject;
use App\Models\School\Teacher;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subject=Subject::all();

        return response()->json([
            'status'=>true,
            'message'=>'fetch all',
            'data'=>$subject,
        ],201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $teacher=Teacher::where('name',$request->input('teacher'))->first();
        // $subject=Subject::create($request->all());
        $subject= new Subject();
        $subject->name=$request->input('name');
        $subject->hours=$request->input('hours');
        $teacher->subjects()->save($subject);

        return response()->json([
            'status'=>true,
            'message'=>'created',
            'data'=>$subject,
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $subject=Subject::find($id);

        // $teacher=Teacher::find(3);
        // $subject=$teacher->subjects;
        // return $subject;

        $subject=Subject::find(2);
        $teacher=$subject->teacher;
        return $teacher;

        // return response()->json([
        //     'status'=>true,
        //     'message'=>'show one',
        //     'data'=>$subject,
        // ],201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $subject=Subject::find($id);
        $subject->update($request->all());

        return response()->json([
            'status'=>true,
            'message'=>'updated',
            'data'=>$subject,
        ],201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subject=Subject::find($id);
        $subject->delete();

        return response()->json([
            'status'=>true,
            'message'=>'deleted',
            'data'=>$subject,
        ],201);
    }

    public function subjectWithTeacher(Request $request)
    {
        $tea=Teacher::where('name',$request->header('name'))->with('subjects')->get();
        return $tea;
    }

    public function subjectWithStudent()
    {
        return Subject::with('students')->get();
    }
}
