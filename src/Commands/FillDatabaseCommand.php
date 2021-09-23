<?php

namespace App\Commands;

use App\Utils\Fetcher\XmlFetcher;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FillDatabaseCommand extends Command
{
    public function __construct(
        private XmlFetcher $xmlFetcher,
        private EntityManagerInterface $em,
    ) {
        parent::__construct();
    }
    protected static $defaultName = 'fill-database';

    protected function configure(): void
    {
        $this->setName(static::$defaultName)
            ->setDescription('Get count by field')
            ->setHelp('Write type, field and value');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        //$this->em->createQuery('DELETE App/Entity/Movie')->execute();

        $count = $this->xmlFetcher->loadXml();
        $output->writeln('Total loaded: ' . $count);

        return Command::SUCCESS;
    }
}