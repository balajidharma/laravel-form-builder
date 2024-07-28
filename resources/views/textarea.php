<?php if ($showLabel && $showField) { ?>
    <?php if ($options['wrapper'] !== false) { ?>
    <div <?= $options['wrapperAttrs'] ?> >
    <?php } ?>
<?php } ?>

<?php if ($showLabel && $options['label'] !== false && $options['label_show']) { ?>
    <?php include labelBlockPath() ?>
<?php } ?>

<?php if ($showField) { ?>

    <textarea name="<?= $name ?>" 
    <?= render_form_attributes($options['attr'] ?? []); ?>
    ><?= $options['value'] ?></textarea>

    <?php include helpBlockPath(); ?>
<?php } ?>

<?php include errorBlockPath(); ?>

<?php if ($showLabel && $showField) { ?>
    <?php if ($options['wrapper'] !== false) { ?>
    </div>
    <?php } ?>
<?php } ?>
