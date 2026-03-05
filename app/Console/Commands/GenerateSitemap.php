<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate {domain?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap.xml file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $domain = $this->argument('domain') ?? 'https://www.mokumbu.com';

        SitemapGenerator::create($domain)
            ->getSitemap()
            ->add(Url::create('/'))
            ->add(Url::create('/login'))
            ->add(Url::create('/register'))
            ->add(Url::create('/terms-and-conditions'))
            ->add(Url::create('/privacy-policy'))
            ->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap generated successfully!');
    }
}
