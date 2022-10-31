<?php

namespace Zabachok\Symfobooster\Input\Extractor;

use Symfony\Component\HttpFoundation\Request;

class BodyExtractor implements ExtractorInterface
{
    public function extract(Request $request, string $name): mixed
    {
        return json_decode((string) $request->getContent(), true);
    }
}
