<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\Scopes\PublishedScope;
use Illuminate\Console\Command;

class PublishPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publishes posts that are scheduled for today.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Post::withoutGlobalScope(PublishedScope::class)
            ->whereDate('published_at', now())
            ->update(['is_published' => true]);
            
        $this->info('Successfully published posts that were scheduled for today.');
    }
}
