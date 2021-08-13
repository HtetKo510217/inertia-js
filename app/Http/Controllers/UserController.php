<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //search
        $users = User::when(
            $request->get('search') ?? '',
            function($query,$search) {
                $query->where('name','like',"%{$search}%")
                      ->orWhere('email','like',"%{$search}%");
            }
        )
        ->orderBy('id','desc')->paginate(5);

        return Inertia::render('User/Index',[
            'users' => $users,
            'search' => $request->get('search')
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('User/Create',[
            'user' => new User,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);
        return redirect()
        ->route('user.index')
        ->with('success','User Created Successfuly');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return Inertia::render('User/Edit',[
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($request->id, 'id'),
            ],
            'password' => 'nullable|min:6'
        ]);

        if($request->filled('password')) {
            $pass = ['password' => $request->password];
            User::find($id)->update($pass);
        }
        $user = [
            'name' => $request->name,
            'email' => $request->email,
        ];
        User::find($id)->update($user);

        return redirect()
        ->route('user.index')
        ->with('success','User Updated successfuly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user =User::find($id);
        $user->delete();
        return redirect()
        ->route('user.index')
        ->with('success','User Delete Successfuly');
    }
}
