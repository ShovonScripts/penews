<?php

namespace App\Console\Commands;

use App\Models\Article;
use Illuminate\Console\Command;

class PublishScheduledArticles extends Command
{
    protected $signature = 'articles:publish-scheduled';
    protected $description = 'Publish articles that are scheduled for now or earlier';

    public function handle(): void
    {
        $count = Article::where('status', 'scheduled')
            ->where('published_at', '<=', now())
            ->update(['status' => 'published']);

        $this->info("{$count} scheduled article(s) published.");
    }
}
