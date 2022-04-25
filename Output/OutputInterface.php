<?php

namespace Zabachok\Symfobooster\Output;

interface OutputInterface
{
    public function getData(): array|object|string;
    public function getCode(): int;
}
