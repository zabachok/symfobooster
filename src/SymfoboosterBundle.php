<?php

namespace Zabachok\Symfobooster;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SymfoboosterBundle extends Bundle
{
    public function getPath(): string
    {
        return dirname(__DIR__);
    }
}
