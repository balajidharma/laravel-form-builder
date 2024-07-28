<?php if ($showLabel && $showField) { ?>
    <?php if ($options['wrapper'] !== false) { ?>
    <div <?= $options['wrapperAttrs'] ?> >
    <?php } ?>
<?php } ?>

<?php if ($showField) { ?>
    <?php if ($showLabel && $options['label'] !== false && $options['label_show']) { ?>
    <label
    <?php
    if (isset($options['label_attr'])) {
        foreach ($options['label_attr'] as $attr => $val) { ?>
        <?php echo $attr.'="'.$val.'"'; ?>
    <?php }
        } ?>
    >
    <input type="checkbox" name="<?= $name ?>" value="<?= $options['value'] ?>" <?= $options['checked'] ? 'checked' : '' ?> 
    <?= render_form_attributes($options['attr'] ?? []); ?>
    />
    <?= $options['label'] ?></label>
    <?php include helpBlockPath(); ?>
    <?php }
    }?>

<?php include errorBlockPath(); ?>

<?php if ($showLabel && $showField) { ?>
    <?php if ($options['wrapper'] !== false) { ?>
    </div>
    <?php } ?>
<?php } ?>
