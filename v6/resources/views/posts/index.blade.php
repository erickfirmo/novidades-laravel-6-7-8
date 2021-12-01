@extends('layouts.app')

@section('content')
    <div class="col-12">
        <a href="{{route('posts.create')}}" class="btn btn-lg btn-success mb-4">
            Criar Postagem
        </a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Título</th>
                <th>Criado em</th>
            </tr>
        </thead>
        <tbody>
            @forelse($posts as $post)
            <tr>
                <td>{{$post->id}}</td>
                <td>
                    <a href="{{route('posts.show', $post->id)}}">
                        {{$post->title}}
                    </a>
                </td>
                <td>{{$post->created_at}}</td>
            </tr>
            @empty
                <tr>
                    <td collspan="3">
                        <h2>Nenhuma postagem encontrada</h2>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $posts->links() }}

@endsection