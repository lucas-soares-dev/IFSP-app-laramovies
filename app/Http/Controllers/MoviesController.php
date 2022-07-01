<?php

namespace App\Http\Controllers;

use App\Helpers\Str;
use App\Models\Movie;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MoviesController extends Controller
{    
    /**
     * Get list movies
     *
     * @return void
     */
    public function index()
    {
        $search = request('search');
        $movies = $search ? Movie::where('name', 'like', "%$search%")->get() : Movie::all();

        return view('home', [
            'search' => $search,
            'movies' => $movies
        ]);
    }
    
    /**
     * Show movies user
     *
     * @return void
     */
    public function movies()
    {
        return view('movies', ['movies' => Auth::user()->movies]);
    }
    
    /**
     * Show details movie
     *
     * @param  string $url
     * @return void
     */
    public function show($url)
    {
        $movie = Movie::where('url', '=', $url)->firstOrFail();
        return view('movies.show', [
            'movie' => $movie
        ]);
    }

    /**
     * Show view create movie
     *
     * @return void
     */
    public function create()
    {
        return view('movies.save');
    }
    
    /**
     * Save movie in database
     *
     * @param  Request $request
     * @return void
     */
    public function save(Request $request, $url = false)
    {
        try {
            $this->validate($request, [
                'name' => 'required|string',
                'genres' => 'required|array',
                'link_trailer' => 'required|url',
                'release_year' => 'required|integer'
            ]);

            $req = $request->toArray();
            $req['url'] = Str::urlEnconde($req['name']);

            if($request->getMethod() === 'POST' && !$url) {
                $req['user_id'] = Auth::user()->id;
                Movie::create($req);
                return redirect('/')->with('success', 'Filme criado com sucesso!');
            }

            $movie = Movie::where('url', '=', $url)->firstOrFail();
            
            if(Auth::user()->id != $movie->user_id) {
                throw new Exception('Você não pode atualizar este filme');
            }

            $movie->update($req);

            return redirect('/')->with('success', 'Filme atualizado com sucesso!');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    
    /**
     * Show form edit movie
     *
     * @param  string $url
     * @return void
     */
    public function edit($url)
    {
        $movieEdit = Movie::where('url', '=', $url)->firstOrFail();

        if($movieEdit->user_id != Auth::user()->id) {
            return redirect('/')->with('error', 'Você não pode editar este filme');;
        }

        return view('movies.save', ['movie' => $movieEdit]);
    }
    
    /**
     * Delete movie
     *
     * @param  string $url
     * @return void
     */
    public function destroy($url)
    {
        $movie = Movie::where('url', '=', $url)->firstOrFail();

        if(Auth::user()->id != $movie->user_id) {
            return redirect('/')->with('error', 'Você não pode deletar este filme');
        }

        $movie->delete();
        return redirect('/')->with('success', 'Filme deletado com successo');
    }
}
