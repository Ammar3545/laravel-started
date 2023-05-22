<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Dotenv\Validator;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class PostsController extends Controller
{
    private $posts = [
        1 =>
        [
            'title' => 'Intro to laravel',
            'content' => 'This is a short intro to laravel',
            'is_new' => true,
            'has_comment' => true
        ],
        2 =>
        [
            'title' => 'Intro to Js',
            'content' => 'This is a short intro to Js',
            'is_new' => true,
            // 'has_comment'=>true
        ],
        3 =>
        [
            'title' => 'Intro to PHP',
            'content' => 'This is a short intro to PHP',
            'is_new' => false,
            // 'has_comment'=>true
        ],
        4 =>
        [
            'title' => 'Intro to Google',
            'content' => 'This is a short intro to Google',
            'is_new' => false,
            'has_comment' => true
        ],
    ];



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $page=DB::table('blog_bosts')->paginate(3);
        // $page = BlogPost::paginate(3);

        $blogs = BlogPost::all();
        return response()->json([
            'status' => true,
            'message' => 'created.',
            'data' => $blogs
        ], 201);
        // $post=DB::select('select * from blog_posts');
        // dd($post);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        // $post=DB::table('blog_posts')->where('id',4)->delete();
        // $post=DB::table('blog_posts')->where('id',4)->update(['title'=>'dart','content'=>'some content of dart']);
        // $post=DB::table('blog_posts')->select(['*'])->get();
        // $post=DB::table('blog_posts')->insert(['id'=>4,'created_at'=>null,'updated_at'=>null,'title'=>'python','content'=>'some content of python']);
        // $post=DB::table('blog_posts')->average('id');
        // $post=DB::table('blog_posts')->sum('id');
        // $post=DB::table('blog_posts')->max('id');
        // $post=DB::table('blog_posts')->count();
        // $post=DB::table('blog_posts')->find(1);
        // $post=DB::table('blog_posts')->orderBy('id')->first();
        // $post=DB::table('blog_posts')->inRandomOrder()->get();
        // $post=DB::table('blog_posts')->oldest()->get();
        // $post=DB::table('blog_posts')->orderBy('id','desc')->get();
        // $post=DB::table('blog_posts')->select('created_at')->distinct()->get();
        // $post=DB::table('blog_posts')->whereNull('created_at')->get();
        // $post=DB::table('blog_posts')->whereBetween('id',[1,20])->get();
        // $post=DB::table('blog_posts')->where('title','like','p%')->orWhere('id',1)->get();
        // $post=DB::table('blog_posts')->select(['title','content'])->where('id',1)->get();
        // $post=DB::table('blog_posts')->where('id',2)->get();
        // $post=DB::select('select * from blog_posts where id =:id',['id'=>2]);
        // $post=DB::select('select * from blog_posts where id =?',[2]);
        // $post=DB::select('select * from blog_posts where id =2');
        // dd($post);
        return 'create';
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $data = $request->validate(
        //     [
        //         'title' => 'required|string|min:2|max:20|unique:blog_posts,title',
        //         'content' => 'required|string|min:2|max:100',
        //     ]
        // );

        $validator=FacadesValidator::make(
            $request->all(),
            [
                'title' => 'required|string|min:2|max:20|unique:blog_posts,title',
                'content' => 'required|string|min:2|max:100',
            ],
            [
                'title.min'=>'اقل عدد احرف ممكن 2',
                'content.string'=>'هذا الحقل يجب ان يكون نص'
            ],
        );
        if (!$validator->fails()) {
            // return $validator->errors();
            $blog = BlogPost::create($validator->getData());

            return response()->json([
                'status' => true,
                'message' => 'created.',
                'data' => $blog
            ], 201);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'vaildation error.',
                'data' => $validator->errors()
            ]);
        }

       
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $blog = BlogPost::find($id);

        return response()->json([
            'status' => true,
            'message' => 'created.',
            'data' => $blog
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'nullable|string|min:2|max:20',
            'content' => 'nullable|string|min:2|max:100',
        ]);

        $blog = BlogPost::find($id);
        
        if ($blog) {
            $blog->updated($data);
            return response()->json([
                'status' => true,
                'message' => 'updated.',
                'data' => $blog
            ],201);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'not found',
                'data' => null
            ],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog=BlogPost::find($id);
        if ($blog) {
            $blog->delete();
            return response()->json([
                'status' => true,
                'message' => 'deleted.',
                'data' => null
            ],201);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'not found.',
                'data' => null
            ],404);
        }
    }
}
