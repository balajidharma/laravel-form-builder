<?php if ($showLabel && $showField) { ?>
    <?php if ($options['wrapper'] !== false) { ?>
    <div <?= $options['wrapperAttrs'] ?> >
    <?php } ?>
<?php } ?>

<?php /** label rendering section */ ?>
<?php if ($showLabel && $options['label'] !== false && $options['label_show']) { ?>
    <?php if (array_key_exists('label_template', $options) && $options['label_template']) { ?>
        <?= view($options['label_template'], get_defined_vars())->render(); ?>
    <?php } else { ?>
        <?php include labelBlockPath(); ?>
    <?php } ?>
<?php } ?>

<?php if ($showField) { ?>
    <div
    <?php
    if (isset($options['choices_wrapper'])) {
        foreach ($options['choices_wrapper'] as $attr => $val) { ?>
        <?php echo $attr.'="'.$val.'"'; ?>
    <?php }
        } ?>
    >

    <?php /** choice rendering section */ ?>
    <?php foreach ((array) $options['children'] as $child) { ?>
        <?= $child->render($options['choice_options'], true, true, false) ?>
    <?php } ?>

    <?php if (isset($options['choices_wrapper'])) { ?>
        </div>
    <?php } ?>

    <?php include helpBlockPath(); ?>

<?php } ?>


<?php include errorBlockPath(); ?>

<?php if ($showLabel && $showField) { ?>
    <?php if ($options['wrapper'] !== false) { ?>
    </div>
    <?php } ?>
<?php } ?>