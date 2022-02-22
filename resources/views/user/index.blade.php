@extends('Edwinpermisos::layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Lista de Usuarios</div>

                    <div class="card-body">
                        @can('haveaccess','user.create')
                        <a class="btn btn-success" href="{{ route('user.create') }}">Crear</a>
                        @endcan
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <td>name</td>
                                    <td>email</td>
                                    <td>Role(s)</td>
                                    <td colspan="3"></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>                               
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @isset($user->roles[0]->name)
                                                {{ $user->roles[0]->name }}
                                            @endisset                                           
                                        </td>
                                        <td>
                                            @can('view',[$user, ['user.show','userown.show']])
                                            <a class="btn btn-secondary" href="{{ route('user.show', $user->id) }}">Show</a>
                                            @endcan
                                        </td>
                                        <td>
                                            @can('update',[$user, ['user.edit','userown.edit']])
                                            <a class="btn btn-warning" href="{{ route('user.edit', $user->id) }}">Edit</a>
                                            @endcan
                                        </td>
                                        <td>
                                            @can('haveaccess','user.destroy')
                                            <form action="{{ route('user.destroy', $user->id) }}" method="POST">
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
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
