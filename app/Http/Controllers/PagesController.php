<?php

namespace App\Http\Controllers;

use Mail;
use App\Product;
use App\Article;
use App\Magazine;
use App\ArticleCategory;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {
        $articles = Article::where('featured', 1)->take(4)->get();

        return view('home')->with('articles', $articles);
    }

    public function blog()
    {
        return view('blog.index')->with('articles', Article::paginate(9));

    }

    public function articleCategory($category)
    {
        $category = ArticleCategory::where('slug', $category)->firstOrFail();
        $articles = $category->articles()->paginate(9);

        return view('blog.index', compact(['category', 'articles']));
    }

    public function article($category, $article)
    {
        $article = Article::where('slug', $article)->firstOrFail();
        $relatedArticles = Article::where('category_id', $article->category_id)
            ->orderByRaw("RAND()")
            ->take(3)
            ->get();

        return view('blog.article', compact(['article', 'relatedArticles']));
    }

    public function search(Request $request)
    {
        $request->validate([ // Anti SPAM honeypot
            'email' => 'max:2'
        ]);

        $products = Product::search($request->get('query'))->paginate(9);
        $search = $request->get('query');
        return view('search', compact(['products', 'search']));

    }

    public function magazineIndex()
    {
        return view('magazine.index')->with('magazines', Magazine::paginate(9));

    }

    public function magazine($magazine)
    {
        return view('magazine.show')->with('magazine', Magazine::where('slug', $magazine)->firstOrFail());
    }

    public function suscripciones()
    {
        return view('suscripciones');

    }

    public function directorios()
    {
        return view('directorios');

    }

    public function contacto()
    {
        return view('contacto');

    }

    public function sendContact(Request $request)
	{
		// Abort if have a link or russian language is detected
        if (preg_match('/[А-Яа-яЁё]/u', $request->get('message')) || $request->get('message') != str_replace('http', '', strip_tags($request->get('message')))) {
            return abort(403, 'No se admite codigo SPAM en el mensaje!');
        }

        $request->validate([ // Anti SPAM honeypot
            'g-recaptcha-response' => 'recaptcha'
        ]);

        Mail::send('emails.contact', [
            'name'  =>  $request->get('name'),
            'email' =>  $request->get('correo'),
            'usermessage' =>  $request->get('message'),

        ], function ($message) use ($request) {

            $message->subject($request->get('subject') . ' | Modo de Vida');
            $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            $message->to('info@mododevida.com');
            $message->bcc('emilianotisato@gmail.com');
        });

        return redirect('/gracias?src=contacto');
    }

    public function privacidad()
    {
        return view('privacidad');

    }

    public function quienes()
    {
        return view('quienes');

    }

    public function press()
    {
        return view('press');

    }

    public function gracias()
    {
        return view('gracias');

    }

    // Sitemaps

    public function index()
    {
        return response()->view('sitemaps.index')->header('Content-Type', 'text/xml');
    }

    public function sitemap_static()
    {
        return response()->view('sitemaps.sitemap_static')
            ->header('Content-Type', 'text/xml');
    }

    public function sitemap_products()
    {
        return response()->view('sitemaps.sitemap_products')
            ->header('Content-Type', 'text/xml');
    }

    public function sitemap_articles()
    {
        return response()->view('sitemaps.sitemap_articles')
            ->header('Content-Type', 'text/xml');
    }

	public function report()
	{
		return view('back.report');
	}
}
