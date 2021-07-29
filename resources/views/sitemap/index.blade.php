<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <sitemap>
        <loc>{{ URL::to('/') }}/sitemap.xml/items</loc>
    </sitemap>
    <sitemap>
        <loc>{{ URL::to('/') }}/sitemap.xml/category</loc>
    </sitemap>
    <sitemap>
        <loc>{{ URL::to('/') }}/sitemap.xml/subcategory</loc>
    </sitemap>
    <sitemap>
        <loc>{{ URL::to('/') }}/sitemap.xml/pages</loc>
    </sitemap>
     <sitemap>
        <loc>{{ URL::to('/') }}/sitemap.xml/blog</loc>
    </sitemap>
    <sitemap>
        <loc>{{ URL::to('/') }}/sitemap.xml/users</loc>
    </sitemap>
</sitemapindex>