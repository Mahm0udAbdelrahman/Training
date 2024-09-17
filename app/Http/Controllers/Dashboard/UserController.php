<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('id', '!=', Auth::user()->id)->latest()->get();
        return view('admin.dashboard.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('id', '!=', Auth::user()->id)->with('roles')->get();
        $roles = Role::get();
        return view('admin.dashboard.users.create',compact('users','roles'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $request->validated();
        $data = $request->all();

        $data['password']= Hash::make($request->password);
        $users = User::create($data);
        $users->assignRole($request->role);
        return redirect()->route('users.index');


    }

    /**
     * Display the specified resource.
     */
    public function show(user $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(user $user)
    {
        $user['roles'] = DB::table('model_has_roles')->where('model_id', $user->id)
            ->where('model_type', 'App\Models\user')->select('role_id')->pluck('role_id');
        $roles = Role::get();
        return view('user.dashboard.users.edit',compact('user','roles'));


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, User $user)
    {
       $data = $request->all();

       if(isset($request->password))
       {
        $data['password']= Hash::make($request->password);
       }
       $user->update($data);
       if (isset($request->role)) {
        $user->roles()->sync($request->role);
        }
        return redirect()->route('users.index');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index');

    }
}
