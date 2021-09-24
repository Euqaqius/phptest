<?php

namespace App\Commands;

use App\Repository\MovieRepository;
use App\Utils\Fetcher\XmlFetcher;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FillDatabaseCommand extends Command
{
    const LIMIT = 10;

    public function __construct(
        private XmlFetcher $xmlFetcher,
        private MovieRepository $movieRepository,
    ) {
        parent::__construct();
    }
    protected static $defaultName = 'fill-database';

    protected function configure(): void
    {
        $this->setName(static::$defaultName)
            ->setDescription('Fill database');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $countDeleted = $this->movieRepository->clearingTables();
        $output->writeln('Total deleted: ' . $countDeleted);

        $countLoaded = $this->xmlFetcher->loadXml();
        $output->writeln('Total loaded: ' . $countLoaded);

        return Command::SUCCESS;
    }
}