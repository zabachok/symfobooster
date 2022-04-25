<?php

namespace Zabachok\Symfobooster\Response;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use Zabachok\Symfobooster\Output\OutputInterface;

class JsonTransformer implements TransformerInterface
{
    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function transform(OutputInterface $output): Response
    {
        return new JsonResponse(
            $this->serializer->serialize($output->getData(), 'json'),
            $output->getCode(),
            [],
            true
        );
    }
}
