<?= "<?php\n" ?>

namespace <?= $namespace; ?>;

use Symfony\Component\Validator\Constraint;
use Zabachok\Symfobooster\Input\InputInterface;

class <?= $class_name ?> implements InputInterface
{
    public function getValidators(): Constraint
    {

    }
}
