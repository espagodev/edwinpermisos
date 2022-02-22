@extends('Edwinpermisos::layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Ver User</div>

                    <div class="card-body">

                        <form action="{{ route('user.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">Rol</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    value="{{ old('name', $user->name) }}" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="slug" class="form-label">Slug</label>
                                <input type="text" name="slug" class="form-control" id="slug"
                                    value="{{ old('slug', $user->email) }}" disabled>
                            </div>
                            
                            <div class="mb-3">
                                <label for="description" class="form-label">Roles</label>
                                <select disabled class="form-control" name="roles" id="roles">
                                    @foreach ($roles as $role )
                                        <option value="{{ $role->id }}"
                                            @isset($user->roles[0]->name)
                                                @if ($role->name == $user->roles[0]->name)
                                                    selected
                                                @endif                                                
                                            @endisset
                                            >{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- <hr>
                            <h3>Role List</h3>
                            @foreach ($permissions as $permission)
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="permission_{{ $permission->id }}"
                                        value="{{ $permission->id }}" name="permission[]"
                                        @if (is_array(old('permission')) && in_array("$permission->id", old('permission'))) checked 

                                        @elseif (is_array($permission_user) && in_array("$permission->id", $permission_user)) checked 
                                        
                                        @endif>
                                    <label class="form-check-label"
                                        for="permission_{{ $permission->id }}">{{ $permission->id }} -
                                        {{ $permission->name }} </label>
                                </div>
                            @endforeach --}}
                            <hr>
                           
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
