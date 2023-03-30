@extends('layouts.app')
@section('content')
<div class="container">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4 class="page-title">Nuevo Role</h4>
            </div>
            <div class="card-body">
                <form action="{{ url('roles', $role->id) }}" method="post">
                    @csrf()
                    @method('PUT')
                    @foreach ($errors->all() as $message)
                        {{ $message }}
                    @endforeach

                    @if(isset($response))
                        {{ $response['message'] }}
                    @endif
                    @if(is_object($role)) 
                        <div class="mb-3">
                        <label for="title" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" id="title" name='name' placeholder="ejm: ROOT ...." value="{{ $role->name }}">
                    </div>
                    @endif
                    

                    <div class="buttons">
                        <button class="btn btn-success" type="submit">Guardar</button>
                        <button class="btn btn-danger" type="button" id="backHistory"> volver </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script defer>
    const goBack = () => {
        window.location = '/roles';
    }
    const btnBack = document.getElementById('backHistory')
    btnBack.addEventListener('click', goBack);
</script>
@endsection