@extends('Edwinpermisos::layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Lista de Roles</div>

                    <div class="card-body">
                        @can('haveaccess','role.create')
                            <a class="btn btn-success" href="{{ route('role.create') }}">Crear</a>
                        @endcan
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <td>name</td>
                                    <td>slug</td>
                                    <td>description</td>
                                    <td>full-access</td>
                                    <td colspan="3"></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    <tr>                               
                                        <td>{{ $role->name }}</td>
                                        <td>{{ $role->slug }}</td>
                                        <td>{{ $role->description }}</td>
                                        <td>{{ $role['full-access'] }}</td>
                                        <td>
                                            @can('haveaccess','role.show')
                                            <a class="btn btn-secondary" href="{{ route('role.show', $role->id) }}">Show</a>
                                            @endcan
                                        </td>
                                        <td>
                                            @can('haveaccess','role.edit')
                                            <a class="btn btn-warning" href="{{ route('role.edit', $role->id) }}">Edit</a>
                                            @endcan
                                        </td>
                                        <td>
                                            @can('haveaccess','role.destroy')
                                            <form action="{{ route('role.destroy', $role->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                  <button class="btn btn-danger">Delete</button>
                                            </form>    
                                            @endcan                                        
                                        </td>
                                
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $roles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
