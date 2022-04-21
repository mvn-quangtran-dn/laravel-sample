<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Profile;
use App\Models\RoleUser;
use DB;
use App\Http\Requests\CreateUserRequest;
use App\Http\Resources\UserResponse;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('posts', 'country')->paginate(10);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $categories = Category::all();
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $data = $request->all();
        if ($request->hasFile('avatar'))
        {
            //upload file
            $newName = \Carbon\Carbon::now()->toString().$request->file('avatar')->getClientOriginalName();
            $path = '/image/users/avatar/';
            $request->file('avatar')->move(public_path($path), $newName);
            $data['avatar'] = $path . $newName;
        }
        $user = User::create($data);

        return redirect()->route('users.show', $user->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id, Request $request)
    {

        $user = User::with(['roles'])->find($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user= User::isOver(30)->get();
        dd($user);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function setRole($id, $roleId)
    {
        $user = User::findOrFail($id);

        // $roleId = [1,2];
        $user->roles()->attach(
            [
                '1' => [
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                '2' => [
                    'created_at' => now(),
                    'updated_at' => now()
                ],
            ]
        );

        // $data = [
        //     'user_id' => $id,
        //     'role_id' => $roleId
        // ];
        // RoleUser::create($data);
        return 'success';

    }
    public function removeRole($id, $roleId)
    {
        $user = User::findOrFail($id);
        $user->roles()->detach($roleId);
        return 'success';
    }
}
