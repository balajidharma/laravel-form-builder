<?php if ($showLabel && $showField) { ?>
    <?php if ($options['wrapper'] !== false) { ?>
    <div <?= $options['wrapperAttrs'] ?> >
    <?php } ?>
<?php } ?>

<?php if ($showLabel && $options['label'] !== false && $options['label_show']) { ?>
    <label for="<?= $name ?>"
    <?php
    if (isset($options['label_attr'])) {
        foreach ($options['label_attr'] as $attr => $val) { ?>
        <?php echo $attr.'="'.$val.'"'; ?>
    <?php }
        } ?>
    ><?= $options['label'] ?></label>
<?php } ?>

<?php if ($showField) { ?>
    <input type="<?= $type ?>" name="<?= $name ?>"  value="<?= $options['value'] ?>"
    <?php
        if (isset($options['attr']) && $type != 'hidden') {
            foreach ($options['attr'] as $attr => $val) { ?>
        <?php echo $attr.'="'.$val.'"'; ?>
    <?php }
            } ?>
    />

    <?php include helpBlockPath(); ?>
<?php } ?>

<?php include errorBlockPath(); ?>

<?php if ($showLabel && $showField) { ?>
    <?php if ($options['wrapper'] !== false) { ?>
    </div>
    <?php } ?>
<?php } ?>
