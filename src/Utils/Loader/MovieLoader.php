<?php

namespace App\Utils\Loader;

use App\Entity\Movie;
use App\Utils\Parsers\XmlParser;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;

class MovieLoader
{
    public function __construct(
        private EntityManagerInterface $em,
        private XmlParser $xmlParser,
    ) {
    }
    /**
     * @var SimpleXMLElement|string
     */
    public function load($rss): int
    {
        $count = 0;
        foreach ($rss->channel->item as $item) {
            $e_content     = $item->children("content", true);
            $e_encoded     = (string)$e_content->encoded;

            $movie = (new Movie())
                ->setLink((string)$item->link)
                ->setTitle((string)$item->title)
                ->setDescription((string)$item->description)
                ->setPubDate(new DateTime($item->pub_date))
                ->setImage($this->xmlParser->imageParser($e_encoded));

            $this->em->persist($movie);

            $count++;
        }

        $this->em->flush();

        return $count;
    }
}
