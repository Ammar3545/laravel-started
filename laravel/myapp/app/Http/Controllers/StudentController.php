<?php

namespace App\Http\Controllers;

use App\Models\School\Section;
use Illuminate\Http\Request;
use App\Models\School\Student;
use App\Models\School\Subject;
use Dotenv\Parser\Value;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $student=Student::all();

        // return response()->json([
        //     'status'=>true,
        //     'message'=>'fetched all',
        //     'data'=>$student,
        // ],201);

        // $counter=0;
        // $data= collect([1=>'salem',2=>'ahmed',3=>'saeed',4=>'ali'])->map(function ($item,$key) use($counter){
        //     return $item.' '.$counter++;
        // });
        // return $data;

        // $data= collect([1,2,3,4]);
        // $col= $data->map(function ($item,$key){
        //     return $item*$key;
        // });
        // return $col;

        return helperSum(51,2);


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $sec= Section::where('name',$request->input('section'))->first();
        $student=new Student();
        $student->name=$request->input('name');
        $student->birthday=$request->input('birthday');
        $student->phone=$request->input('phone');
        $student->address=$request->input('address');
        $sec->students()->save($student);

        return response()->json([
            'status'=>true,
            'message'=>'created',
            'data'=>$student,
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // $student=Student::find($id);

        // $student=Student::find(1);
        // $section=$student->sections;
        // $section=Section::find(1);

        // $student->sections()->associate($section)->save();

        $section=Section::find(1);
        $student=$section->students;
        return $student;



        // return response()->json([
        //     'status'=>true,
        //     'message'=>'show one',
        //     'data'=>$student,
        // ],201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $student=Student::find($id);
        $student->update($request->all());
        return response()->json([
            'status'=>true,
            'message'=>'updated',
            'data'=>$student,
        ],201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student=Student::find($id);
        $student->delete();

        return response()->json([
            'status'=>true,
            'message'=>'deleted',
            'data'=>$student,
        ],201);
    }

    public function studentWithSubject()
    {
        $stu_id=[];
        $sub_id=[];
        $sub=Subject::all();
        foreach ($sub as $key => $value) {
            array_push($sub_id,$value->id);
        }
        $stu=Student::all();
        foreach ($stu as $key => $value) {
            array_push($stu_id,$value->id);
            $stud=Student::find($value->id);
            $stud->subjects()->sync($sub_id);

        }
        return Student::with('subjects')->get();

    }
}
