<?php if ($options['wrapper'] !== false) { ?>
<div <?= $options['wrapperAttrs'] ?> >
<?php } ?>

<button type="<?= $type ?>"
    <?= render_form_attributes($options['attr'] ?? []); ?>
><?= $options['label'] ?></button>
<?php include helpBlockPath(); ?>

<?php if ($options['wrapper'] !== false) { ?>
</div>
<?php } ?>
