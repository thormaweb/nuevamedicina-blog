@php
    echo '<?xml version="1.0" encoding="UTF-8"?>';
@endphp
<urlset
        xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">

    <url>
        <loc>https://www.mododevida.com/tienda</loc>
        <lastmod>{{ date('c', time()) }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.00</priority>
    </url>

    <url>
        <loc>https://www.mododevida.com/tienda/decoracion</loc>
        <lastmod>{{ date('c', time()) }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.90</priority>
    </url>

    <url>
        <loc>https://www.mododevida.com/tienda/remodelacion</loc>
        <lastmod>{{ date('c', time()) }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.90</priority>
    </url>

    @inject('categories', 'App\ProductCategory')

    @foreach($categories->main()->ordered()->get() as $mainCat)
        @foreach($mainCat->categories()->ordered()->get() as $parentCat)
            @if($parentCat->is_parent)
                @php $lastProductModified = 1; @endphp
                @foreach($parentCat->categories()->ordered()->get() as $childCat)
                    @if($childCat->products->count() >= 1)
                        <url>
                            <loc>https://www.mododevida.com/tienda/categoria/{{ $parentCat->slug }}/{{ $childCat->slug }}</loc>
                            <lastmod>{{ date('c', $childCat->products()->lastModified()->first()->updated_at->timestamp) }}</lastmod>
                            <changefreq>weekly</changefreq>
                            <priority>0.70</priority>
                        </url>
                        @foreach($childCat->products as $product)
                            <url>
                                <loc>https://www.mododevida.com/tienda/{{ $product->vendor->slug }}/{{ $product->slug }}</loc>
                                <lastmod>{{ date('c', $product->updated_at->timestamp) }}</lastmod>
                                <changefreq>monthly</changefreq>
                                <priority>0.60</priority>
                            </url>
                            @if($lastProductModified < $product->updated_at->timestamp)
                                @php $lastProductModified = $product->updated_at->timestamp @endphp
                            @endif

                        @endforeach
                    @endif
                @endforeach
                <url>
                    <loc>https://www.mododevida.com/tienda/categoria/{{ $parentCat->slug }}</loc>
                    <lastmod>{{ date('c', $lastProductModified) }}</lastmod>
                    <changefreq>daily</changefreq>
                    <priority>0.80</priority>
                </url>
            @else
                @if($parentCat->products->count() >= 1)
                    <url>
                        <loc>https://www.mododevida.com/tienda/categoria/{{ $parentCat->slug }}</loc>
                        <lastmod>{{ date('c', $parentCat->products()->lastModified()->first()->updated_at->timestamp) }}</lastmod>
                        <changefreq>daily</changefreq>
                        <priority>0.80</priority>
                    </url>
                    @foreach($parentCat->products as $product)
                        <url>
                            <loc>https://www.mododevida.com/tienda/{{ $product->vendor->slug }}/{{ $product->slug }}</loc>
                            <lastmod>{{ date('c', $product->updated_at->timestamp) }}</lastmod>
                            <changefreq>monthly</changefreq>
                            <priority>0.60</priority>
                        </url>
                    @endforeach
                @endif
            @endif
        @endforeach
    @endforeach

    @inject('vendors', 'App\Vendor')

    @foreach($vendors->all() as $vendor)
        @if($vendor->products->count() >= 1)
            <url>
                <loc>https://www.mododevida.com/tienda/{{ $vendor->slug }}</loc>
                <lastmod>{{ date('c', $vendor->products()->lastModified()->first()->updated_at->timestamp) }}</lastmod>
                <changefreq>weekly</changefreq>
                <priority>0.70</priority>
            </url>
        @endif
    @endforeach

</urlset>