<?php

namespace Zabachok\Symfobooster\Maker;

use Symfony\Bundle\MakerBundle\ConsoleStyle;
use Symfony\Bundle\MakerBundle\Generator;
use Symfony\Component\Console\Input\InputInterface;
use Zabachok\Symfobooster\Maker\Endpoint\Manifest\Manifest;

abstract class AbstractMaker implements MakerInterface
{
    protected InputInterface $input;
    protected ConsoleStyle $io;
    protected Generator $generator;
    protected Manifest $manifest;

    public function __construct(InputInterface $input, ConsoleStyle $io, Generator $generator, Manifest $manifest)
    {
        $this->input = $input;
        $this->io = $io;
        $this->generator = $generator;
        $this->manifest = $manifest;
    }
}
