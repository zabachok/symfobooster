<?php

namespace Zabachok\Symfobooster\Service;

use Zabachok\Symfobooster\Input\InputInterface;

interface ServiceInterface
{
    public function behave(InputInterface $input);
}
