<?php if ($showLabel && $showField) { ?>
    <?php if ($options['wrapper'] !== false) { ?>
    <div <?= $options['wrapperAttrs'] ?> >
    <?php } ?>
<?php } ?>

<?php if ($showLabel && $options['label'] !== false && $options['label_show']) { ?>
    <?php include labelBlockPath() ?>
<?php } ?>

<?php if ($showField) { ?>
    <?php foreach ((array) $options['children'] as $child) { ?>
        <?= $child->render() ?>
    <?php } ?>

    <?php include helpBlockPath(); ?>

<?php } ?>

<?php include errorBlockPath(); ?>

<?php if ($showLabel && $showField) { ?>
    <?php if ($options['wrapper'] !== false) { ?>
    </div>
    <?php } ?>
<?php } ?>
