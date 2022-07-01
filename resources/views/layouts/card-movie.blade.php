<a class="col-lg-6 col-xl-4 position-relative text-decoration-none" href="/movies/{{ $movie->url }}">
    <div 
        class="card card-cover h-100 overflow-hidden text-white bg-dark rounded-5 shadow-lg" 
        style="background-image: url(https://img.youtube.com/vi/{{ explode('v=', $movie->link_trailer)[1] }}/mqdefault.jpg);"
    >
        @auth
            @if (auth()->user()->id === $movie->user_id)
                <div class="tags position-absolute p-3 d-flex justify-content-between col-12">
                    <div class="left">
                        <span class="tag m-2 bg-danger rounded px-2 py-1">Postado por você</span>
                    </div>

                    <div class="right">
                        <span class="tag m-2 bg-primary rounded px-2 py-1">
                            Editar
                        </span>
                        <span class="tag m-2 bg-warning text-dark rounded px-2 py-1">
                            Excluir
                        </span>
                    </div>
                </div>
            @endif
        @endauth

        <div class="d-flex flex-column justify-content-end h-100 p-4 pb-3 text-white text-shadow-1">
            <h2 class="pt-5 mt-5 mb-1 display-6 lh-1 fw-bold" id="movie-title">{{ $movie->name }}</h2>

            <ul class="d-flex list-unstyled justify-content-between mb-0">
                <li class="d-flex align-items-center">
                    <small>{{ implode(', ', $movie->genres) }}</small>
                </li>

                <li class="d-flex align-items-center">
                    <span class="bi bi-calendar3 me-2"></span>
                    <small>{{  date('d/m/Y', strtotime($movie->created_at)) }}</small>
                </li>
            </ul>
        </div>
    </div>
</a>