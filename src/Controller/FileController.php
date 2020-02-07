<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\NdJson\NdJsonReadTransport;
use App\Service\NdJson\NdJsonWriteTransport;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Process\Process;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/file")
 */
class FileController extends AbstractController
{
    /**
     * @param int             $count
     * @param KernelInterface $kernel
     *
     * @return StreamedResponse
     *
     * @Route("/download/{count<\d+>?1000}", name="download")
     */
    public function download(int $count, KernelInterface $kernel): Response
    {
        $filename = $kernel->getProjectDir().'/var/products_'.$count.'.ndjson';
        if (!is_file($filename)) {
            $process = new Process(['php', 'console', 'app:gen-products', $count]);
            $process->setWorkingDirectory($kernel->getProjectDir().'/bin');
            $process->run();
            if (0 !== $process->getExitCode()) {
                return new Response('', Response::HTTP_NOT_FOUND);
            }
        }

        $response = new StreamedResponse(static function () use ($filename) {
            $file = fopen($filename, 'rb');
            $ndJsonReadTransport = new NdJsonReadTransport($file);
            $ndJsonWriteTransport = new NdJsonWriteTransport();

            foreach ($ndJsonReadTransport->readProducts() as $product) {
                $ndJsonWriteTransport->addProduct($product);
            }
            $ndJsonReadTransport->close();
            $ndJsonWriteTransport->close();
        });

        $response->headers->set('X-Accel-Buffering', 'no');
        $response->headers->set('Content-Type', 'application/force-download');

        return $response;
    }

    /**
     * @param Request $request
     *
     * @return Response
     * @throws \Exception
     *
     * @Route("/upload", methods={"POST"}, name="upload")
     */
    public function upload(Request $request): Response
    {
        $file = $request->getContent(true);
        $ndJsonReadTransport = new NdJsonReadTransport($file);

        $count = 0;
        foreach ($ndJsonReadTransport->readProducts() as $product) {
            ++$count;
        }

        return new JsonResponse(['status' => 'OK', 'uploadedProductsCount' => $count]);
    }
}
