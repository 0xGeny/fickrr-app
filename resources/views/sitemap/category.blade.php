<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($category as $categories)
        <url>
            <loc>{{ URL::to('/') }}/shop/category/{{ $categories->cat_id }}/{{ $categories->category_slug }}</loc>
            <lastmod>{{ date('Y-m-d H:i:s') }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.9</priority>
        </url>
    @endforeach
</urlset>