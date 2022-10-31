<?php
/** @var \Zabachok\Symfobooster\Maker\Endpoint\Manifest\Field[] $fields */
/** @var \Zabachok\Symfobooster\Maker\Endpoint\Manifest\Input $input */
echo "<?php\n";
?>

namespace <?= $namespace; ?>;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints as Assert;
use Zabachok\Symfobooster\Input\InputInterface;
<?php if($input->hasMuted): ?>
use Zabachok\Symfobooster\Input\Attributes\Muted;
<?php endif; ?>
<?php if($input->hadRenamed): ?>
use Zabachok\Symfobooster\Input\Attributes\Renamed;
<?php endif; ?>

class <?= $class_name ?> implements InputInterface
{
<?php foreach ($fields as $key => $field): ?>
<?php if($key > 0): ?>

<?php endif; ?>
<?php if($field->muted): ?>
    #[Muted]
<?php endif; ?>
<?php if($field->renamed): ?>
    #[Renamed('<?= $field->renamed ?>')]
<?php endif; ?>
    public <?= $field->type ?> $<?= $field->name ?>;
<?php endforeach; ?>

    public function getValidators(): Constraint
    {
        return
            new Assert\Collection(
                [
<?php foreach ($fields as $field): ?>
                    '<?= $field->name ?>' => [
                        new Assert\Required(),
                        new Assert\Type('<?= $field->type ?>'),
                    ],
<?php endforeach; ?>
                ]
            );
    }
}
