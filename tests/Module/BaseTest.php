<?php

declare(strict_types=1);

namespace App\Tests\Module;

use PHPUnit\Framework\TestCase;

class BaseTest extends TestCase
{
    public function testBase(): void
    {
        $this->assertEquals(1, 1);
    }
}
