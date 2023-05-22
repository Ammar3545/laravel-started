<?php

namespace App\Http\Controllers;

use App\Models\School\Section;
use App\Models\School\Student;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $section=Section::all();

        return response()->json([
            'status'=>true,
            'message'=>'fetch all',
            'data'=>$section,
        ],201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $section=Section::create($request->all());

        return response()->json([
            'status'=>true,
            'message'=>'created',
            'data'=>$section,
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $section=Section::find($id);

        // $section=Section::find(1);
        // $student=$section->students;
        // return $student;

        // $sec=Section::find(1);
        $stu=Student::where('name','salem')->first()->section_id;
        $section=Section::select('name')->where('id',$stu)->first()->name;
        return $section;

        // return response()->json([
        //     'status'=>true,
        //     'message'=>'show one',
        //     'data'=>$section,
        // ],201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $section=Section::find($id);
        $section->update($request->all());

        return response()->json([
            'status'=>true,
            'message'=>'updated',
            'data'=>$section,
        ],201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $section=Section::find($id);
        $section->delete();

        return response()->json([
            'status'=>true,
            'message'=>'deleted',
            'data'=>$section,
        ],201);

    }
}
