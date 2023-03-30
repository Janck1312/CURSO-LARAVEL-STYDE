@extends('layouts.app')
@section('content')
<div class="container">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4 class="page-title">Nuevo Usuario</h4>
            </div>
            <div class="card-body">
                <form action="{{ url('users') }}" method="post">
                    @csrf()
                    @foreach ($errors->all() as $message)
                    {{ $message }}
                    @endforeach

                    @if(isset($response))
                    {{ $response['message'] }}
                    @endif
                    <div class="mb-3">
                        <label for="title" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" id="title" name='name' placeholder="ejm: pedro....">
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Email:</label>
                        <input type="email" name="email" class="form-control rounded">
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Contraseña:</label>
                        <input type="password" name="password" class="form-control rounded">
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Confirmación de contraseña:</label>
                        <input type="password" name="password_confirmation" class="form-control rounded">
                    </div>

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
        window.location = '/users';
    }
    const btnBack = document.getElementById('backHistory')
    btnBack.addEventListener('click', goBack);
</script>
@endsection