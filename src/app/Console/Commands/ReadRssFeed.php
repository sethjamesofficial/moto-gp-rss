<?php

namespace App\Console\Commands;

use Exception;
use SimpleXMLElement;
use App\Traits\OpensRssFeed;
use Illuminate\Console\Command;

class ReadRssFeed extends Command
{
    use OpensRssFeed;
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rss:read {url=https://www.motogp.com/en/news/rss : The url of the RSS feed to be read}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Read the RSS feed and output to the console.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $xml = $this->readFeed($this->argument('url'));

        $this->info($xml->channel->title);        
        $this->info("---");        
        foreach($xml->channel->item as $item)
        {
            $this->info($item->title);
        }  
    }
}
