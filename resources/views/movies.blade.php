@extends('layouts.main')

@section('title', 'Meus Filmes')

@section('content')

<div class="py-5">
    @include('layouts.button-to-home')

    <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4">
        @foreach ($movies as $movie)
            @include('layouts.card-movie', ['movie', $movie])
        @endforeach
    </div>
</div>

@endsection