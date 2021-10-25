<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($usuarios as $usuario)
        <url>
            <loc>{{ url('/') }}/page/{{ $usuario->url }}</loc>
            <lastmod>{{ $usuario->created_at }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach
</urlset>