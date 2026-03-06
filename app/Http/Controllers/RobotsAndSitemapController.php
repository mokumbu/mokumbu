<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;

class RobotsAndSitemapController extends Controller
{
    public function robots()
    {
        $content = "User-agent: *\n";

        if (app()->environment('production')) {
            $content .= "Allow: /\n";
            $content .= "\n";
            $content .= "Sitemap: " . url('/sitemap.xml') . "\n";
        } else {
            $content .= "Disallow: /\n";
        }

        return response($content, 200)
            ->header('Content-Type', 'text/plain');
    }

    public function sitemap()
    {
        $urls = [
            ['loc' => route('home')],
            ['loc' => route('privacy-policy')],
            ['loc' => route('terms-and-conditions')],
        ];

        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        foreach ($urls as $url) {
            $xml .= '<url>';
            $xml .= '<loc>' . $url['loc'] . '</loc>';
            $xml .= '</url>';
        }

        $xml .= '</urlset>';

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }
}
