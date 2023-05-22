<?php

namespace App\Http\Controllers;

use App\Models\School\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $level=Level::all();

        return response()->json([
            'status'=>true,
            'message'=>'all',
            'data'=>$level,
        ],201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $level=Level::create($request->all());

        return response()->json([
            'status'=>true,
            'message'=>'created',
            'data'=>$level,
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $level=Level::find($id);

        return response()->json([
            'status'=>true,
            'message'=>'show',
            'data'=>$level,
        ],201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $level=Level::find($id);
        $level->update($request->all());

        return response()->json([
            'status'=>true,
            'message'=>'updated',
            'data'=>$level,
        ],201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $level=Level::find($id);
        $level->delete();

        return response()->json([
            'status'=>true,
            'message'=>'deleted',
            'data'=>$level,
        ],201);
    }
}
