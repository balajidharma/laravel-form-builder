<?php if ($showLabel && $showField) { ?>
    <?php if ($options['wrapper'] !== false) { ?>
    <div <?= $options['wrapperAttrs'] ?> >
    <?php } ?>
<?php } ?>

<?php if ($showField) { ?>
    <?= Form::checkbox($name, $options['value'], $options['checked'], $options['attr']) ?>

    <?php if ($showLabel && $options['label'] !== false && $options['label_show']) { ?>
        <?= Form::customLabel($name, $options['label'], $options['label_attr']) ?>
    <?php } ?>

    <?php include helpBlockPath(); ?>
<?php } ?>

<?php include errorBlockPath(); ?>

<?php if ($showLabel && $showField) { ?>
    <?php if ($options['wrapper'] !== false) { ?>
    </div>
    <?php } ?>
<?php } ?>
