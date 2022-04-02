<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Item;
use App\Models\Channel;
use App\Traits\OpensRssFeed;
use Illuminate\Console\Command;

class ImportRssFeed extends Command
{
    use OpensRssFeed;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rss:import {url=https://www.motogp.com/en/news/rss : The url of the RSS feed to be imported to the database}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports an RSS feed to the database from a URL';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $xml = $this->readFeed($this->argument('url'));

        foreach($xml->channel as $xmlChannel)
        {
            $dbChannel = Channel::create([
                'title' => $xmlChannel->title,
                'link' => $xmlChannel->link,
                'description' => $xmlChannel->description,
                'language' => $xmlChannel->language,
            ]);

            foreach($xmlChannel->item as $xmlItem)
            {
                Item::create([
                    'channel_id' => $dbChannel->id,
                    'title' => $xmlItem->title,
                    'link' => $xmlItem->link,
                    'description' => $xmlItem->description,
                    'pub_date' => Carbon::parse($xmlItem->pubDate),
                    'image_link' => $xmlItem->image,
                ]);
            }
        }
    }
}
