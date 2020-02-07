<?php

declare(strict_types=1);

namespace App\Command;

use App\Service\NdJson\DataTransformer;
use App\Service\NdJson\NdJsonReadTransport;
use App\Service\ProductService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpKernel\KernelInterface;

class UploadProductsCommand extends Command
{
    private const HTTP_END_POINT = 'http://localhost:8081/file/upload';

    protected static $defaultName = 'app:upload-products';

    private ProductService $productService;

    private KernelInterface $kernel;

    /**
     * GenProductsCommand constructor.
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
            ->setDescription('Upload products')
            ->addArgument('count', InputArgument::REQUIRED, 'Products count')
            ->addOption('visible', null, InputOption::VALUE_NONE, 'Visible IDs');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $startTime = microtime(true);

        $io = new SymfonyStyle($input, $output);
        $count = (int) $input->getArgument('count');

        if ($count <= 0) {
            $io->error('Count must be greater then 0');
        }

        $filename = $this->kernel->getProjectDir().'/var/products_'.$count.'.ndjson';
        if (!is_file($filename)) {
            $this->productService->genProductsFile($count);
        }

        $file = fopen($filename, 'rb');
        $ndJsonReadTransport = new NdJsonReadTransport($file);

        $client = HttpClient::create();
        $response = $client->request('POST', self::HTTP_END_POINT, [
            'body' => $ndJsonReadTransport->readProductsAsString(),
        ]);

        $io->writeln(sprintf("Status:\n%d", $response->getStatusCode()));
        $io->writeln(sprintf("Response:\n%s", $response->getContent()));

        $ndJsonReadTransport->close();

        $endTime = microtime(true);
        $executeTime = round($endTime - $startTime, 5);

        $io->success(sprintf('%d products has been uploaded (%s ms).', $count, $executeTime));

        return 0;
    }
}
