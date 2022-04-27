<?= "<?php\n" ?>

namespace <?= $namespace; ?>;

use Zabachok\Symfobooster\Output\Success;
use Zabachok\Symfobooster\Service\ServiceInterface;
use Zabachok\Symfobooster\Input\InputInterface;
use Zabachok\Symfobooster\Output\OutputInterface;

class <?= $class_name ?> implements ServiceInterface
{
    public function __construct() {
    }

    /**
     * @param InputInterface $dto
     */
    public function behave(InputInterface $dto): OutputInterface
    {
        return new Success([]);
    }
}
