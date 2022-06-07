<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use App\Models\Profile;
use App\Models\RoleUser;
use DB;
use App\Http\Requests\CreateUserRequest;
use App\Http\Resources\UserResponse;
use Exception;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function __construct()
    {
    //    $this->middleware('is.admin')->except('index', 'create');
    }

    /**
     * Get the user resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUser()
    {
        $user1 = User::getByName('Sandrine Hayes');
        $user2 = User::findByNameAndEmail('Ariel Pfeffer', 'jaiden64@example.com');
        $user3 = User::findByCountry(1);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectRoute()
    {
        return redirect()->to('/users');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('country', 'profile')->get();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if (request()->user()->cannot('createUser', User::class)){
        //     abort(403);
        // }
        // dd('d');
        // if (!Gate::allows('create-user', User::class)) {
        //     return abort(403);
        // }
        // $this->authorize('create', User::class);
        $countries = Country::get();
        return view('users.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('avatar')) //check file exist
        {
            //upload file
            $newName = \Carbon\Carbon::now()->timestamp.$request->file('avatar')->getClientOriginalName(); // change image's name to unique name
            $path = '/image/users/avatar/'; // path to upload image
            $request->file('avatar')->move(public_path($path), $newName);
            $data['avatar'] = $path . $newName;
        }
        DB::beginTransaction();
        try {
            $user = User::create($data);
            $profileData = [
                'address' => '12 Le Loi',
                'tel' => '02491318241',
                'age' => rand(1,100),
                'gender' => rand(0,1),
                'user_id' => $user->id
            ];
            Profile::create($profileData);
            DB::commit();
            return redirect()->route('users.index');
        } catch (Exception $ex) {
            DB::rollback();
            return redirect()->back()->with(['error'=> 'Create user error !!'] );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user, Request $request)
    {

        // $user = User::with(['roles'])->find($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $countries = Country::get();
        // $user = User::find($id);
        return view('users.edit', compact('user','countries'));
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
        $user = User::find($id);
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $user->update($data);
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->profile()->delete();
        $user->delete();
        return redirect()->route('users.index');
    }
}
