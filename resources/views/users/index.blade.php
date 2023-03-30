@extends('layouts.app')

@section('content')
<div class="container">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4 class="page-title">
                    Usuarios
                </h4>
                <button class="btn btn-success" type="button" id="newPost">
                    Añadir
                </button>
            </div>
            <div class="card-body">
                <div class="table table-responsive">
                    <table class="table table-info">
                        <thead class="text-center">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Creación</th>
                                <th></th>
                            </tr>
                        </thead>
                        @if($users)
                        <tbody class="text-center">
                            @foreach($users as $key)
                            <tr>
                                <td>{{ $key->id }}</td>
                                <td>{{ $key->name }}</td>
                                <td>{{ $key->email }}</td>
                                <td>{{ $key->created_at }}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning" type="button" value="{{ $key->id }}">
                                        <a href="users/update/{{$key->id}}">
                                            actualizar
                                        </a>
                                    </button>
                                    <form action="{{ url('users', $key->id) }}" method="post" onsubmit="return confirmDeleteRecord(e)">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" type="submit">eliminar</button>
                                    </form>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        @elseif(!isset($users))
                        <tbody class="text-center">
                            <tr>
                                <td colspan="6">
                                    No hay registros para mostrar...
                                </td>
                            </tr>
                        </tbody>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script defer>
    const create = () => {
        window.location = 'users/create';
    }
    const btnCreate = document.getElementById('newPost');
    btnCreate.addEventListener('click', create)

    function confirmDeleteRecord(e) {
        e.preventDefault();
        if (confirm('Realmente quiere borrar el usuario??')) {
            e();
        } else {
            e.preventDefault();
        }
    }
</script>

@endsection