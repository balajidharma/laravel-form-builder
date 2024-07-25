<?php if ($showLabel && $showField) { ?>
    <?php if ($options['wrapper'] !== false) { ?>
    <div <?= $options['wrapperAttrs'] ?> >
    <?php } ?>
<?php } ?>

<?php if ($showField) { ?>
    <?= $options['children']['first']->render([], true, true, false) ?>
    <?= $options['children']['second']->render([], true, true, false) ?>

    <?php include helpBlockPath(); ?>

<?php } ?>

<?php if ($showError && isset($errors)) { ?>
    <?= $options['children']['first']->render([], false, false, true) ?>
    <?= $options['children']['second']->render([], false, false, true) ?>
<?php } ?>

<?php if ($showLabel && $showField) { ?>
    <?php if ($options['wrapper'] !== false) { ?>
    </div>
    <?php } ?>
<?php } ?>
