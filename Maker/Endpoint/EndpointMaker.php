<?php

namespace Zabachok\Symfobooster\Maker\Endpoint;

use Symfony\Bundle\MakerBundle\ConsoleStyle;
use Symfony\Bundle\MakerBundle\DependencyBuilder;
use Symfony\Bundle\MakerBundle\Exception\RuntimeCommandException;
use Symfony\Bundle\MakerBundle\Generator;
use Symfony\Bundle\MakerBundle\InputConfiguration;
use Symfony\Bundle\MakerBundle\Maker\AbstractMaker;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Yaml\Yaml;
use Zabachok\Symfobooster\Hydrator;
use Zabachok\Symfobooster\Maker\Endpoint\Maker\ServiceMaker;
use Zabachok\Symfobooster\Maker\Endpoint\Manifest\Manifest;

class EndpointMaker extends AbstractMaker
{
    public static function getCommandName(): string
    {
        return 'make:endpoint';
    }

    public static function getCommandDescription(): string
    {
        return 'Make new api endpoint from manifest file';
    }

    public function configureCommand(Command $command, InputConfiguration $inputConfig)
    {
        $command->addOption('manifest', 'm', InputOption::VALUE_REQUIRED, 'Manifest file');
    }

    public function configureDependencies(DependencyBuilder $dependencies)
    {
    }

    public function generate(InputInterface $input, ConsoleStyle $io, Generator $generator)
    {
        if (!$input->hasOption('manifest')) {
            throw new RuntimeCommandException('--manifest option is required');
        }
        $manifestFilePath = $generator->getRootDirectory() . '/' . $input->getOption('manifest');
        if (!file_exists($manifestFilePath)) {
            throw new RuntimeCommandException('Manifest file not found');
        }
        $rawManifest = Yaml::parse(file_get_contents($manifestFilePath));
        $hydrator = new Hydrator();
        $manifest = $hydrator->hydrate(Manifest::class, $rawManifest);

        $maker = new ServiceMaker($input, $io, $generator, $manifest);
        $maker->make();

        $generator->writeChanges();

        $this->writeSuccessMessage($io);
    }
}
