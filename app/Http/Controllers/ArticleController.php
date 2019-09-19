<?php

namespace App\Http\Controllers;

use App\Image;
use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\Session;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('inactive')) {
            return view('back.articles.index')->with('articles', Article::withoutGlobalScopes()->where('enable', 0)->orderBy('created_at', 'DESC')->paginate());
        }

        if ($request->has('q')) {
            return view('back.articles.index')->with('articles', Article::where('name', 'like', '%' . $request->get('q') . '%')->paginate());
        }

        return view('back.articles.index')->with('articles', Article::paginate());
    }

    public function create()
    {
        return view('back.articles.create');
    }

    public function store(ArticleRequest $request)
    {
        $article = Article::create($request->all());

        if ($request->hasFile('image')) {

            $image = new Image;
            $image->procesImage($request->file('image'), 'articles', 1200, 600);
            $article->images()->create([
                'url' => $image->url,
                'order' => 1,
            ]);
        }


        Session::flash('flash_message', 'success');
        Session::flash('message_strong', 'Bien hecho!');
        Session::flash('message', 'El articulo se ha agregado satisfactoriamente');

        return redirect()->route('articleBack');
    }

    public function view($id)
    {
        return view('back.articles.edit')->withArticle(Article::withoutGlobalScopes()->findOrFail($id));
    }

    public function edit($id, ArticleRequest $request)
    {
        $article = Article::withoutGlobalScopes()->findOrFail($id);
        $article->update($request->all());

        if(! $request->has('enable')) {
            $article->update(['enable' => 0]);
        }

        if(! $request->has('featured')) {
            $article->update(['featured' => 0]);
        }


        if ($request->hasFile('image')) {

            if ($article->featuredImage()) {
                $images = $article->images()->get();
                foreach ($images as $image) {
                    File::delete(public_path('photos/' . $image->url));
                    $image->delete();
                }
            }

            $image = new Image;
            $image->procesImage($request->file('image'), 'articles', 1200, 600);
            $article->images()->create([
                'url' => $image->url,
                'order' => 1,
            ]);
        }

        Session::flash('flash_message', 'success');
        Session::flash('message_strong', 'Bien hecho!');
        Session::flash('message', 'El articulo se ha modificado satisfactoriamente');

        return redirect()->route('articleBack');
    }

    public function destroy($id)
    {
        $article = Article::withoutGlobalScopes()->findOrFail($id);

        // Get images and delete them
        $images = $article->images()->get();
        foreach ($images as $image) {
            File::delete(public_path('photos/' . $image->url));
            $image->delete();
        }

        // Finally delete article
       $article->delete();

        Session::flash('flash_message', 'success');
        Session::flash('message_strong', 'Aviso!');
        Session::flash('message', 'El articulo se ha eliminado del sitio');

        return redirect()->route('articleBack');
    }
}
