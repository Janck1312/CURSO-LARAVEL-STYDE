@extends('layouts.app')

@section('content')
<div class="container">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4 class="page-title">
                    Roles
                </h4>
                <button class="btn btn-success" type="button" id="newPost">
                    Añadir
                </button>
            </div>
            <div class="card-body">
                <div class="table table-responsive">
                    <table class="table table-info">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>creacion</th>
                                <th>Fecha de actualización</th>
                                <th></th>
                            </tr>
                        </thead>
                        @if($role)
                        <tbody class="text-center">
                            @foreach($role as $key)
                            <tr>
                                <td>{{ $key->id }}</td>
                                <td>{{ $key->name }}</td>
                                <td>{{ $key->created_at }}</td>
                                <td>{{ $key->updated_at }}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning" type="button" value="{{ $key->id }}">
                                        <a href="roles/update/{{$key->id}}">
                                            actualizar
                                        </a>
                                    </button>
                                    <form action="{{ url('roles', $key->id) }}" method="post" onsubmit="return confirmDeleteRecord(e)">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" type="submit">eliminar</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        @elseif(!isset($role))
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
        window.location = 'roles/create';
    }
    const btnCreate = document.getElementById('newPost');
    btnCreate.addEventListener('click', create)

    function confirmDeleteRecord(e) {
        e.preventDefault();
        if (confirm('Realmente quiere borrar el role??')) {
            e();
        } else {
            e.preventDefault();
        }
    }
</script>

@endsection