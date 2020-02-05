<?php

declare(strict_types=1);

namespace App\Service\StreamingJsonParser;

use JsonStreamingParser\Listener\SimpleObjectQueueListener;
use JsonStreamingParser\Parser;

class StreamingJsonParserService
{
    public function read(string $filename)
    {
        $stream = fopen($filename, 'rb');
        $listener = new SimpleObjectQueueListener();

        try {
            $parser = new Parser($stream, $listener);
            $parser->parse();
        } catch (\Throwable $e) {
            fclose($stream);
            throw $e;
        }


    }
}
