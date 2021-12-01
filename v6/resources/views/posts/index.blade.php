@extends('layouts.app')

@section('content')
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
                <td>{{$post->title}}</td>
                <td>{{$post->created_at}}</td>
            </tr>
            @empty
                <tr>
                    <td collspan="3">
                        <h2>Nenhum post encontrado</h2>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $posts->links() }}

@endsection