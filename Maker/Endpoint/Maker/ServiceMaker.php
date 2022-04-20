<?php

namespace Zabachok\Symfobooster\Maker\Endpoint\Maker;

use Zabachok\Symfobooster\Maker\AbstractMaker;

class ServiceMaker extends AbstractMaker
{

    public function make(): void
    {
        $serviceDetails = $this->generator->createClassNameDetails(
            $this->manifest->endpoint,
            'Domain\\' . $this->manifest->domain . '\\Service\\',
            'Service'
        );
//        $this->manifest->serviceClass = $serviceDetails->getFullName();
        $this->generator->generateClass(
            $serviceDetails->getFullName(),
            __DIR__ . '/templates/service.tpl.php',
            []
        );
    }
}
