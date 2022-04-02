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
            $dbChannel = Channel::updateOrCreate(
                ['link' => $xmlChannel->link],
                [
                    'title' => $xmlChannel->title,
                    'description' => $xmlChannel->description,
                    'language' => $xmlChannel->language,
                ]
            );

            foreach($xmlChannel->item as $xmlItem)
            {
                Item::updateOrCreate(
                    [
                        'link' => $xmlItem->link,
                        'channel_id' => $dbChannel->id,
                    ],
                    [
                        'title' => $xmlItem->title,
                        'description' => $xmlItem->description,
                        'pub_date' => Carbon::parse($xmlItem->pubDate),
                        'image_link' => $xmlItem->image,
                    ]
                );
            }
        }
    }
}
