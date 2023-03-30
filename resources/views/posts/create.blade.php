@extends('layouts.app')
@section('content')
<div class="container">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4 class="page-title">Nuevo post</h4>
            </div>
            <div class="card-body">
                <form action="{{ url('posts') }}" method="post">
                    @csrf()
                    @foreach ($errors->all() as $message)
                        {{ $message }}
                    @endforeach

                    @if(isset($response))
                        {{ $response['message'] }}
                    @endif
                    <div class="mb-3">
                        <label for="title" class="form-label">Título</label>
                        <input type="text" class="form-control" id="title" name='title' placeholder="ejm: El clima tormentoso ....">
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Contenido:</label>
                        <textarea class="form-control" id="content" rows="3" name="content"></textarea>
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
        window.location = '/posts';
    }
    const btnBack = document.getElementById('backHistory')
    btnBack.addEventListener('click', goBack);
</script>
@endsection