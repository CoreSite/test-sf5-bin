<?php

declare(strict_types=1);

namespace App\Command;

use App\Service\ProductService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpKernel\KernelInterface;

class GenProductsCommand extends Command
{
    protected static $defaultName = 'app:gen-products';

    private ProductService $productService;

    private KernelInterface $kernel;

    /**
     * GenProductsCommand constructor.
     * @param ProductService  $productService
     * @param KernelInterface $kernel
     */
    public function __construct(ProductService $productService, KernelInterface $kernel)
    {
        $this->productService = $productService;
        $this->kernel = $kernel;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Generate products')
            ->addArgument('count', InputArgument::REQUIRED, 'Count products');
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $count = (int) $input->getArgument('count');

        if ($count <= 0) {
            $io->error('Count must be greater then 0');
        }

        $this->productService->genProductsFile($count);

        $io->success('OK');

        return 0;
    }
}
