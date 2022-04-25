<?php

namespace Zabachok\Symfobooster\Maker\Endpoint\Maker;

use Zabachok\Symfobooster\Maker\AbstractMaker;

class InputMaker extends AbstractMaker
{

    public function make(): void
    {
        print_r($this->manifest->input->fields);
        $serviceDetails = $this->generator->createClassNameDetails(
            $this->manifest->endpoint,
            'Domain\\' . ucfirst($this->manifest->domain) . '\\Input\\',
            'Input'
        );
        $this->storage->set('inputClass', $serviceDetails->getFullName());
        $this->generator->generateClass(
            $serviceDetails->getFullName(),
            __DIR__ . '/templates/input.tpl.php',
            [
                'fields' => $this->manifest->input->fields,
                'input' => $this->manifest->input,
            ]
        );
    }
}
