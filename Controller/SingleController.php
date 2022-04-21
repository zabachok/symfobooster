<?php

namespace Zabachok\Symfobooster\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Zabachok\Symfobooster\Input\InputLoader;

class SingleController
{
    private InputLoader $inputLoader;

    public function __construct(InputLoader $inputLoader, string $test)
    {
        $this->inputLoader = $inputLoader;
    }

    public function action(Request $request): Response
    {
        $input = $this->inputLoader->fromRequest($request);

        return new Response('test content');
    }
}
