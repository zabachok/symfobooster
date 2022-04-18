<?php

namespace Zabachok\Symfobooster\Tests\Input\Transformer;

use PHPUnit\Framework\TestCase;
use Zabachok\Symfobooster\Input\Transformer\ExplodeTransformer;

class ExplodeTransformerTest extends TestCase
{
    public function testSuccess(): void
    {
        $transformer = new ExplodeTransformer();
        $this->assertEquals(['1', '2'], $transformer->transform('1,2'));
    }
}
