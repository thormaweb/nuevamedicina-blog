@php
    echo '<?xml version="1.0" encoding="UTF-8"?>';
@endphp
<urlset
        xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">

    <url>
        <loc>https://www.mododevida.com/articulos</loc>
        <lastmod>{{ date('c', time()) }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.00</priority>
    </url>

    @inject('categories', 'App\ArticleCategory')

    @foreach($categories->all() as $category)
        @if($category->articles->count() >= 1)
            <url>
                <loc>https://www.mododevida.com/articulos/{{ $category->slug }}</loc>
                <lastmod>{{ date('c', $category->articles()->lastModified()->first()->updated_at->timestamp) }}</lastmod>
                <changefreq>weekly</changefreq>
                <priority>0.70</priority>
            </url>

            @foreach($category->articles as $article)
                <url>
                    <loc>https://www.mododevida.com/articulos/{{ $article->category->slug }}/{{ $article->slug }}</loc>
                    <lastmod>{{ date('c', $article->updated_at->timestamp) }}</lastmod>
                    <changefreq>monthly</changefreq>
                    <priority>0.60</priority>
                </url>
            @endforeach

        @endif
    @endforeach
</urlset>