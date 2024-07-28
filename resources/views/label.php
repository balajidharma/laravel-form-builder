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