<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidationRequest;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use App\Models\groub1;
use App\Models\groub2;
// use App\Models\groubBetween;
use App\Models\Profile;
use App\Models\Upload;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class AuthorController extends Controller
{
    public function store(ValidationRequest $request)
    {

        $request->validated();
        // $pro = Profile::create($request->all());
        // return response()->json([
        //     'satus' => true,
        //     'message' => 'create',
        //     'data' => $pro,
        // ]);
        $auth = Author::create([
            $request->all()
            // 'name'=>$request->input('name'),
            // 'book'=>$request->input('book'),
        ]);
        return response()->json([
            'satus' => true,
            'message' => 'create',
            'data' => $auth,
        ], 201);
        // return 'ok';
    }

    public function show()
    {
        // $pro=Profile::find(1);
        // return $pro->authors->get();
        // $author = Author::find(1); //->profiles
        // return $author->with('profiles');
        $auth = Author::all();
        return AuthorResource::collection($auth);
    }

    public function gro()
    {
        // auth()->attempt();
        // auth()->user();

        $gr = groub2::with('groub1')->get();
        // $gr = groub2::with('groub1')->whereHas('groub1',function ($go){ this to deal with relation to get data from inside ,not in the root
        //     $go->where('name','dary');
        // })->get();
        return $gr;
    }

    public function login(Request $request)
    {
        //     validator($request->all(),
        //     [
        //         'email'=>['required','email'],
        //         'pass'=>['required'],
        //     ]
        // )->validate();

        // if (auth()->attempt($request->only(['email','password']))) {
        //     return 'okkkkkk your are authenticate';
        // }
        // return 'sorry';

        // }


        $user = User::where('email', $request->email)->get();
        // return User::where('email', $request->email)->get();

        if (Hash::check($request->password, $user->password)) {
            return [
                'token' => $user->createToken(time())->plainTextToken
            ];
        }
    }

    public function search($name = null)
    {
        return Author::where('name', 'like', '%' . $name . '%')->where('id', null)->get();
        // return Author::where('name',$name)->orWhere();
        // return Author::orderBy('id','asc')->paginate(5);
        // return Author::where('name',$name)->get();
    }

    public function shows()
    {
        return view('upload');
    }

    public function stores(Request $request)
    { //upload image to project folder
        $image = $request->file('photo')->getClientOriginalName();
        $path = $request->file('photo')->storeAs('user', $image, 'storage');
        Upload::create([
            'path' => $path,
        ]);
        return 'done';
    }

    public function filter()
    {
        //     $users = QueryBuilder::for(Author::class)
        //              ->allowedFilters([
        //     AllowedFilter::exact('name'),
        //      'book'
        //     ])
        // ->get();
        $users = QueryBuilder::for(Author::class)
            ->allowedFilters([
                AllowedFilter::exact('name')->default('saeed'),
                // AllowedFilter::scope(false)
                // 'name',
                // 'book',
            ])->get();

        return $users;
    }
}
