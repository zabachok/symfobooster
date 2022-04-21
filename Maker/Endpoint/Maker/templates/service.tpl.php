<?= "<?php\n" ?>

namespace <?= $namespace; ?>;

use Zabachok\Symfobooster\Service\ServiceInterface;
use Zabachok\Symfobooster\Input\InputInterface;

class <?= $class_name ?> implements ServiceInterface
{
    public function __construct() {
    }

    /**
     * @param InputInterface $dto
     */
    public function behave(InputInterface $dto)
    {

    }
}
