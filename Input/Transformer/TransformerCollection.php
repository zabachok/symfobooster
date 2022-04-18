<?php

namespace Zabachok\Symfobooster\Input\Transformer;

use Zabachok\Symfobooster\Input\Transformer\Exception\InvalidTransformerException;

class TransformerCollection
{
    private array $collection = [];

    public function __construct(array $transformers)
    {
        foreach ($transformers as $field => $fieldTransformers) {
            if (!is_string($field)) {
                throw new InvalidTransformerException('Keys in a collection must be a request fields');
            }
            if (!is_array($fieldTransformers)) {
                throw new InvalidTransformerException('Transformer collection must be array');
            }
            $this->addTransformers($field, $fieldTransformers);
        }
    }

    public function getTransformersByField(string $field): array
    {
        return array_key_exists($field, $this->collection) ? $this->collection[$field] : [];
    }

    private function addTransformers(string $field, array $transformers): void
    {
        foreach ($transformers as $transformer) {
            $this->addTransformer($field, $transformer);
        }
    }

    private function addTransformer(string $field, TransformerInterface $transformer): void
    {
        if (!array_key_exists($field, $this->collection)) {
            $this->collection[$field] = [];
        }

        $this->collection[$field][] = $transformer;
    }
}
