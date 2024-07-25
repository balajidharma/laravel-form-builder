<?php if ($showLabel && $showField) { ?>
    <?php if ($options['wrapper'] !== false) { ?>
    <div <?= $options['wrapperAttrs'] ?> >
    <?php } ?>
<?php } ?>

<?php if ($showLabel && $options['label'] !== false && $options['label_show']) { ?>
    <?= Form::customLabel($name, $options['label'], $options['label_attr']) ?>
<?php } ?>

<?php if ($showField) { ?>
    <?php foreach ((array) $options['children'] as $child) { ?>
        <?php if (! in_array($child->getRealName(), (array) $options['exclude'])) { ?>
            <?= $child->render() ?>
        <?php } ?>
    <?php } ?>

    <?php include helpBlockPath(); ?>

<?php } ?>

<?php include errorBlockPath(); ?>

<?php if ($showLabel && $showField) { ?>
    <?php if ($options['wrapper'] !== false) { ?>
    </div>
    <?php } ?>
<?php } ?>
