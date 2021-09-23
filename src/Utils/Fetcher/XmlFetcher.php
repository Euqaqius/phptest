<?php

namespace App\Utils\Fetcher;


use App\Entity\Movie;
use App\Utils\Loader\MovieLoader;

class XmlFetcher
{
    public function __construct(
        private MovieLoader $movieLoader,
    ) {
    }

    public function loadXml(): int
    {
        $rss = simplexml_load_file('https://trailers.apple.com/trailers/home/rss/newtrailers.rss');

        if (!$rss) {
          return 0;
        }

        return $this->movieLoader->load($rss);
    }
}
