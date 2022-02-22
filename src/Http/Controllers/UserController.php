<?php

namespace Edwin\Edwinpermisos\Http\Controllers;

use App\Http\Controllers\Controller;
use Edwin\Edwinpermisos\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('haveaccess','user.index');

        $users = User::with('roles')->orderBy('id','Desc')->paginate(2);

        return view('Edwinpermisos::user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $this->authorize('create', User::class);

        // return 'create';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $this->authorize('view', [$user, ['user.show','userown.show']]);

        $roles = Role::orderBy('name')->get();     

        return view('Edwinpermisos::user.show', compact('user', 'roles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

         $this->authorize('update', [$user, ['user.edit','userown.edit']]);

        $roles = Role::orderBy('name')->get();     

        return view('Edwinpermisos::user.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|unique:users,name,'.$user->id,
            'email' => 'required|unique:users,email,'.$user->id

           ]);
    
           $user->update($request->all());
    
           
            $user->roles()->sync($request->get('roles'));
      

           return redirect()->route('user.index')->with('status_success','Usuario Modificado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('haveaccess','user.destroy');

        $user->delete();
        return redirect()->route('user.index')->with('status_success','Usuario Eliminado');
    }
}
