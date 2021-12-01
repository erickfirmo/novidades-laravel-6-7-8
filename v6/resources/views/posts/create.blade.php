@extends('layouts.app')

@section('content')
    <form action="{{route('posts.store')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Título</label>
            <input type="text" class="form-control" name="title" id="title">
        </div>
        <div class="form-group">
            <label for="description">Descrição</label>
            <textarea class="form-control" name="description" id="description" cols="30" rows="10">
            </textarea>
        </div>

        <button type="submit" class="btn btn-lg btn-success">Criar Postagem</button>
    </form>
@endsection