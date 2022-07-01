@extends('layouts.main')

@section('title', 'Criar filme')

@section('content')

<div class="py-5">
    @auth
    @if (auth()->user()->id == $movie->user_id)
    <div class="owner-options d-flex">
        <a class="btn btn-primary mx-2" href="/movies/edit/{{ $movie->url }}">
            Editar <span class="bi bi-pen"></span>
        </a>

        <form action="/movies/delete/{{ $movie->url }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger delete-btn ml-1">
                Excluir <span class="bi bi-trash3-fill"></span>
            </button>
        </form>
    </div>
    @endif
    @endauth

    <div class="infos-movie mt-3">
        @include('layouts.button-to-home')

        <iframe width="100%" height="500px" src="{{ 'https://www.youtube.com/embed/' . explode('v=', $movie->link_trailer)[1] }}"></iframe>

        <div class="mt-3">
            <h1>{{ $movie->name }}</h1>

            <div class="infos-movie-content mt-4">
                <p><strong>Gêneros:</strong> {{ implode(', ', $movie->genres) }}</p>
                <p><strong>Ano de Lançamento:</strong> {{ $movie->release_year }}</p>
                <p><strong>Autor:</strong> {{ $movie->user->name }}</p>
            </div>
        </div>
    </div>
</div>

@endsection