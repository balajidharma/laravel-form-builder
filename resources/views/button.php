<?php if ($options['wrapper'] !== false) { ?>
<div <?= $options['wrapperAttrs'] ?> >
<?php } ?>

<button type="<?= $type ?>"
    <?php
    if (isset($options['attr']) && $type != 'hidden') {
        foreach ($options['attr'] as $attr => $val) { ?>
        <?php echo $attr.'="'.$val.'"'; ?>
    <?php }
        } ?>
><?= $options['label'] ?></button>
<?php include helpBlockPath(); ?>

<?php if ($options['wrapper'] !== false) { ?>
</div>
<?php } ?>
