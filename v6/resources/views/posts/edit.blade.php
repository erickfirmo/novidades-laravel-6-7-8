@extends('layouts.app')

@section('content')
    <form action="{{route('posts.update', ['post' => $post->id])}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Título</label>
            <input type="text" class="form-control" name="title" id="title" value="{{$post->title}}">
        </div>
        <div class="form-group">
            <label for="description">Descrição</label>
            <textarea class="form-control" name="description" id="description" cols="30" rows="10" value="{{$post->description}}">
            </textarea>
        </div>

        <button type="submit" class="btn btn-lg btn-success">Atualizar Postagem</button>
    </form>
    
@endsection