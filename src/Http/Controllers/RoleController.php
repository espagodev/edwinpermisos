<?php

namespace Edwin\Edwinpermisos\Http\Controllers;

use App\Http\Controllers\Controller;
use Edwin\Edwinpermisos\Models\Permission;
use Edwin\Edwinpermisos\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('haveaccess','role.index');

        $roles = Role::orderBy('id','Desc')->paginate(2);

        return view('Edwinpermisos::role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('haveaccess','role.create');

        $permissions = Permission::get();

        return view('Edwinpermisos::role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('haveaccess','role.create');

       $request->validate([
        'name' => 'required|unique:roles,name',
        'slug' => 'required|unique:roles,slug',
        'full-access' => 'required|in:yes,no'
       ]);

       $role = Role::create($request->all());

       if($request->get('permission')){
            // return $request->all();
            $role->permissions()->sync($request->get('permission'));
       }
       return redirect()->route('role.index')->with('status_success','Rol Creado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        Gate::authorize('haveaccess','role.show');

        $permission_role=[];

        foreach ($role->permissions as $permission) {
            $permission_role[] = $permission->id;
        }

        $permissions = Permission::get();       

        return view('Edwinpermisos::role.show', compact('permissions','role','permission_role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        Gate::authorize('haveaccess','role.edit');

        $permission_role=[];

        foreach ($role->permissions as $permission) {
            $permission_role[] = $permission->id;
        }

        $permissions = Permission::get();       

        return view('Edwinpermisos::role.edit', compact('permissions','role','permission_role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        Gate::authorize('haveaccess','role.edit');

        $request->validate([
            'name' => 'required|unique:roles,name,'.$role->id,
            'slug' => 'required|unique:roles,slug,'.$role->id,
            'full-access' => 'required|in:yes,no'
           ]);
    
           $role->update($request->all());
    
           if($request->get('permission')){
                $role->permissions()->sync($request->get('permission'));
           }
           return redirect()->route('role.index')->with('status_success','Rol Modificado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        Gate::authorize('haveaccess','role.destroy');

        $role->delete();
        return redirect()->route('role.index')->with('status_success','Rol Eliminado');
    
    }
}
