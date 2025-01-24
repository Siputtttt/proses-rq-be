<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\news;
use App\Models\Category;

class FetchPublicData extends Command
{
    protected $signature = 'fetch:public-data';
    protected $description = 'Fetch public data and save to database';

    public function handle()
    {
        $response_category = Http::get('https://api.nytimes.com/svc/news/v3/content/section-list.json?limit=60&api-key=xKZC4vmGAYF7rWfG8ho4F1Aasycji7Qx');
        $rows_category = $response_category->json()['results'];

        $response_news = Http::get('https://api.nytimes.com/svc/news/v3/content/all/all.json?limit=60&api-key=xKZC4vmGAYF7rWfG8ho4F1Aasycji7Qx');
        $rows_news = $response_news->json()['results'];

        foreach ($rows_category as $item) {
            Category::create([
                'name' => $item['display_name']
            ]);
        }
         
        foreach ($rows_news as $item) {
            news::create([
                'writer' => $item['byline'],
                'title' => $item['title'],
                'abstract' => $item['abstract'],
                'category' => $item['section'],
                'date' => now()->format('Y-m-d')
            ]);
        }
    }
}
