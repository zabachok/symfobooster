<?php

namespace Zabachok\Symfobooster\Maker\Endpoint\Manifest;

use Zabachok\Symfobooster\Hydrator;

class Input
{
    public array $fields = [];
    public bool $hasMuted = false;
    public bool $hadRenamed = false;

    public function setFields(array $fields): void
    {
        $hydrator = new Hydrator();
        foreach ($fields as $key => $manifest) {
            /** @var Field $field */
            $field = $hydrator->hydrate(Field::class, $manifest);
            $field->name = $key;
            if ($field->muted) {
                $this->hasMuted = true;
            }
            if ($field->renamed) {
                $this->hadRenamed = true;
            }
            $this->fields[] = $field;
        }
    }
}
