<?php

declare(strict_types=1);

namespace App\Command;

use App\Service\NdJson\NdJsonReadTransport;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class DownloadProductsCommand extends Command
{
    protected static $defaultName = 'app:download-products';

    protected function configure()
    {
        $this
            ->setDescription('Download NDJSON')
            ->addArgument('filename', InputArgument::OPTIONAL, 'File name')
            ->addOption('visible', null, InputOption::VALUE_NONE, 'Visible IDs');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $filename = $input->getArgument('filename');

        $file = fopen($filename, 'rb');

        $ndJsonReadTransport = new NdJsonReadTransport($file);

        $count = 0;
        foreach ($ndJsonReadTransport->readProducts() as $product) {
            if ($input->getOption('visible')) {
                $io->writeln($product->getId()->toString());
            }
            ++$count;
        }

        $ndJsonReadTransport->close();
        $io->success(sprintf('Downloaded %d products', $count));

        return 0;
    }
}