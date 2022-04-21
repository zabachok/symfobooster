<?php

namespace Zabachok\Symfobooster\Input;

use ReflectionAttribute;
use ReflectionClass;
use Symfony\Component\HttpFoundation\Request;
use Zabachok\Symfobooster\Hydrator;
use Zabachok\Symfobooster\Input\Attributes\Muted;
use Zabachok\Symfobooster\Input\Attributes\Renamed;
use Zabachok\Symfobooster\Input\Attributes\Source;
use Zabachok\Symfobooster\Input\Extractor\ExtractorFactory;

class InputLoader
{
    private InputInterface $input;
    private array $fields = [];
    private array $muted = [];
    private array $renamed = [];
    private ExtractorFactory $extractorFactory;

    public function __construct(InputInterface $input, ExtractorFactory $extractorFactory)
    {
        $this->input = $input;
        $this->extractorFactory = $extractorFactory;
    }

    public function fromRequest(Request $request): InputInterface
    {
        $this->exploreInput($request->getMethod());
        $data = $this->extractData($request);
        $hydrator = new Hydrator();
        $hydrator->hydrate($this->input, $data);

        return $this->input;
    }

    private function exploreInput(string $method): void
    {
        $reflection = new ReflectionClass(get_class($this->input));

        foreach ($reflection->getProperties() as $property) {
            $source = $this->getSource($method, $property->getAttributes(Source::class)[0] ?? null);
            $this->fields[$property->getName()] = $source;

            if (!empty($property->getAttributes(Muted::class))) {
                $this->muted[] = $property->getName();
            }

            $renamed = $property->getAttributes(Renamed::class);
            if (!empty($renamed)) {
                $this->renamed[$property->getName()] = $renamed[0]->newInstance()->externalName;
            }
        }
    }

    private function getSource(string $method, ?ReflectionAttribute $attribute): string
    {
        if (is_null($attribute)) {
            return $method === 'GET' ? 'query' : 'body';
        }

        return $attribute->newInstance()->source;
    }

    private function extractData(Request $request): array
    {
        $data = [];
        foreach ($this->fields as $field => $source) {
            $value = $this->extractorFactory->getExtractor($source)->extract(
                $request,
                array_key_exists($field, $this->renamed) ? $this->renamed[$field] : $field
            );
            if (!is_null($value)) {
                $data[$field] = $value;
            }
        }
        return $data;
    }
}
