@extends('Edwinpermisos::layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Editar Rol</div>

                    <div class="card-body">

                        <form action="{{ route('role.update', $role->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">Rol</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    value="{{ old('name', $role->name) }}">
                            </div>
                            <div class="mb-3">
                                <label for="slug" class="form-label">Slug</label>
                                <input type="text" name="slug" class="form-control" id="slug"
                                    value="{{ old('slug', $role->slug) }}">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <input type="text" name="description" class="form-control" id="description"
                                    value="{{ old('description', $role->description) }}">
                            </div>
                            <h3>Full Access</h3>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="full-access" id="fullAccessYes"
                                    value="yes"
                                    @if ($role['full-access'] == 'yes') checked
                                    @elseif (old('full-access') == 'yes')
                                        checked @endif>
                                <label class="form-check-label" for="fullAccessYes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="full-access" id="fullAccessNo" value="no"
                                    @if ($role['full-access'] == 'no') checked
                                @elseif (old('full-access') == 'no') 
                                    checked @endif>
                                <label class="form-check-label" for="fullAccessNo">No</label>
                            </div>
                            <hr>
                            <h3>Permission List</h3>
                            @foreach ($permissions as $permission)
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="permission_{{ $permission->id }}"
                                        value="{{ $permission->id }}" name="permission[]"
                                        @if (is_array(old('permission')) && in_array("$permission->id", old('permission'))) checked 

                                        @elseif (is_array($permission_role) && in_array("$permission->id", $permission_role)) checked 
                                        
                                        @endif>
                                    <label class="form-check-label"
                                        for="permission_{{ $permission->id }}">{{ $permission->id }} -
                                        {{ $permission->name }} </label>
                                </div>
                            @endforeach
                            <hr>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
