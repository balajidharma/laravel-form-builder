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
    <?php $emptyVal = $options['empty_value'] ? ['' => $options['empty_value']] : null; ?>
    <select name="<?= $name ?>" 
    <?= render_form_attributes($options['attr'] ?? []); ?>
    >
        <?php if ($options['empty_value']) { ?>
            <option value=""><?= $options['empty_value'] ?></option>
        <?php } ?>
        <?php foreach ($options['choices'] as $key => $value) { ?>
            <option value="<?= $key ?>" <?= in_array($key, (array) $options['selected']) ? 'selected = "selected"' : '' ?>
            <?php
                    if (isset($options['option_attributes'])) {
                        foreach ($options['option_attributes'] as $attr => $val) { ?>
            <?php echo $attr.'="'.$val.'"'; ?>
        <?php }
                        } ?>
            ><?= $value ?></option>
        <?php } ?>
    </select>

    <?php include helpBlockPath(); ?>
<?php } ?>

<?php include errorBlockPath(); ?>

<?php if ($showLabel && $showField) { ?>
    <?php if ($options['wrapper'] !== false) { ?>
    </div>
    <?php } ?>
<?php } ?>