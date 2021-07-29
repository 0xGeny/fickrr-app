<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($subcategory as $categories)
        <url>
            <loc>{{ URL::to('/') }}/shop/subcategory/{{ $categories->subcat_id }}/{{ $categories->subcategory_slug }}</loc>
            <lastmod>{{ date('Y-m-d H:i:s') }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.9</priority>
        </url>
    @endforeach
</urlset>