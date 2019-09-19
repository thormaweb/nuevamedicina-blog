@php
    echo '<?xml version="1.0" encoding="UTF-8"?>';
@endphp
<urlset
        xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">

    <url>
        <loc>https://www.mododevida.com</loc>
        <lastmod>{{ date('Y') }}-01-01</lastmod>
        <changefreq>yearly</changefreq>
        <priority>1.00</priority>
    </url>

    <url>
        <loc>https://www.mododevida.com/quienes-somos</loc>
        <lastmod>{{ date('Y') }}-01-01</lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.50</priority>
    </url>

    <url>
        <loc>https://www.mododevida.com/suscripciones</loc>
        <lastmod>{{ date('Y') }}-01-01</lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.40</priority>
    </url>

    <url>
        <loc>https://www.mododevida.com/politica-de-privacidad</loc>
        <lastmod>{{ date('Y') }}-01-01</lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.40</priority>
    </url>

    <url>
        <loc>https://www.mododevida.com/contacto</loc>
        <lastmod>{{ date('Y') }}-01-01</lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.40</priority>
    </url>

</urlset>