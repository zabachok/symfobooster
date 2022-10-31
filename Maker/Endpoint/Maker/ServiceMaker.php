<?php

namespace Zabachok\Symfobooster\Maker\Endpoint\Maker;

use Nette\PhpGenerator\PhpFile;
use Zabachok\Symfobooster\Input\InputInterface;
use Zabachok\Symfobooster\Maker\AbstractMaker;
use Zabachok\Symfobooster\Maker\Endpoint\Manifest\Field;
use Zabachok\Symfobooster\Output\OutputInterface;
use Zabachok\Symfobooster\Service\ServiceInterface;

class ServiceMaker extends AbstractMaker
{

    public function make(): void
    {
        $file = new PhpFile();
        $file->setStrictTypes();

        $namespace = $file->addNamespace(
            'App\\Domain\\' . ucfirst($this->manifest->domain) . '\\' . ucfirst($this->manifest->endpoint)
        );
        $namespace->addUse(ServiceInterface::class);
        $namespace->addUse(OutputInterface::class);
        $namespace->addUse(InputInterface::class);
        $namespace->addUse($namespace->getName() . '\\' . $this->storage->get('outputClass'));

        $class = $namespace->addClass('Service')
            ->addImplement(ServiceInterface::class);

        $method = $class->addMethod('behave');
            $method
            ->setReturnType(OutputInterface::class)
            ->addBody('return new Output();');
        $method->addParameter('input')->setType(InputInterface::class);

//        $class->addParameter('input', [InputInterface::class])->

        $content = (string)$file;

        $path = $this->generator->getRootDirectory() . '/src/Domain/' . ucfirst(
                $this->manifest->domain
            ) . '/' . ucfirst($this->manifest->endpoint) . '/Service.php';
        $directory = dirname($path);

        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }
        file_put_contents($path, $content);
    }
}
