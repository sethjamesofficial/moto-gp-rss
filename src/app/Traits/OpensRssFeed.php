<?php

namespace App\Traits;

use Exception;
use SimpleXMLElement;

/**
 * Provides functions to read an rss feed to SimpleXMLElement from a URL
 */
trait OpensRssFeed
{

    /**
     * Read an rss feed to SimpleXMLElement from a URL
     *
     * @param String $url
     * @return SimpleXMLElement
     */
    public function readFeed(String $url)
    {
        $content = file_get_contents($url);

        try { 
            $xml = new SimpleXMLElement($content);
        }
        catch (Exception $e) {
            $this->error($e->getMessage());
            die();
        }

        return $xml;
    }
}