@extends('layouts.app')
@section('content')
<div class="container">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4 class="page-title">Actualizar post</h4>
            </div>
            <div class="card-body">
                @foreach ($errors->all() as $message)
                {{ $message }}
                @endforeach

                @if(isset($response))
                {{ print($response['message']) }}
                se muestra si existe un mensaje
                @endif

                <form action="{{ url('posts', $updatingPost->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    @if(is_object($updatingPost))
                    <div class="mb-3">
                        <label for="title" class="form-label">Título</label>
                        <input type="text" class="form-control" id="title" name='title' placeholder="ejm: El clima tormentoso ...." value="{{$updatingPost->title}}">
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Contenido:</label>
                        <textarea class="form-control" id="content" rows="3" name="content" value="{{$updatingPost->content}}">{{$updatingPost->content}}</textarea>
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
        window.location = '/posts';
    }
    const btnBack = document.getElementById('backHistory')
    btnBack.addEventListener('click', goBack);
</script>
@endsection