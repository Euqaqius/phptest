<?php

namespace App\Utils\Parsers;

use DOMDocument;

class XmlParser
{
    public function imageParser(string $e_encoded): string
    {
        $dom = new DOMDocument();
        $dom->loadHTML($e_encoded);
        $images = $dom->getElementsByTagName('img');

        $imageUrl = '';
        foreach ($images as $image) {
            $imageUrl = $image->getAttribute('src');
        }

        return $imageUrl;
    }
}
