@extends('layouts.main')

@section('title', 'Home')

@section('content')

<section class="py-5">
    @if ($search)
        <h2>Buscando por: {{ $search }}</h2>
    @else
        <h2>Filmes</h2>
    @endif

    <div class="content">
        <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4">
            @foreach ($movies as $movie)
                @include('layouts.card-movie', ['movie', $movie])
            @endforeach
        </div>

        <div class="mt-5">
            @if (count($movies) == 0 && $search)
                <p>Não foi encontrado nenhum filme com <strong>{{ $search }}</strong>. <a href="/">Clique aqui</a> para ver todos.</p>
            @elseif (count($movies) == 0)
                <p>Não há filmes disponíveis</p>
            @endif
        </div>
    </div>
</section>

@endsection