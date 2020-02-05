<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Routing\Annotation\Route;

class UploaderController extends AbstractController
{
    /**
     * @Route("/uploader", name="uploader")
     */
    public function index(): StreamedResponse
    {
        $response = new StreamedResponse(static function () {
            ob_start();
            echo 'Start!';
            ob_flush();
            flush();
            sleep(1);
            echo 'Step 1';
            ob_flush();
            flush();
            sleep(2);
            echo 'Step 2';
            ob_flush();
            flush();
            sleep(2);
            echo 'end';
            ob_flush();
            flush();
            sleep(1);
        });

        $response->headers->get('X-Accel-Buffering', 'no');

        return $response;
    }
}
