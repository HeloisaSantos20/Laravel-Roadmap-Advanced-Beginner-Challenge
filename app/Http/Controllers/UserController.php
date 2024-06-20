<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $userRequest = $request->input('user');

        $users = User::when($userRequest, function ($query) use ($userRequest) {
            $query->where('name',  'like', "%$userRequest%");
        }) ->latest()->paginate(50);

        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rolesList = Role::query()->orderBy('name', 'ASC')->get()->map(function ($role) {
            return ['id' => $role->id, 'nome' => $role->display_name];
        });

        return view('users.create', ['rolesList' => $rolesList]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request)
    {
        $request = $request->validated();

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
        ]);

        $user->roles()->sync($request['role']);


        session()->flash('messageSuccess', 'User successfully created!');
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);

        return view('users.user', ['user' => $user]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);

        $rolesList = Role::query()->orderBy('name', 'ASC')->get()->map(function ($role) {
            return ['id' => $role->id, 'nome' => $role->display_name];
        });

        return view('users.edit', ['user' => $user, 'rolesList' => $rolesList]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, string $id)
    {
        $user = User::findOrFail($id);

        $request = $request->validated();

        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->save();

        $user->roles()->sync($request['role']);

        session()->flash('messageSuccess', 'User successfully updated!');
        return redirect()->route('users.show', [$user->id] );

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        $user->delete();
        session()->flash('messageSuccess','User successfully deleted!');

        return redirect(route('users.index'));
    }
}
