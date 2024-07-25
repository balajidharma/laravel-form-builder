<?php if ($showLabel && $showField) { ?>
	<?php if ($options['wrapper'] !== false) { ?>
		<div <?php echo $options['wrapperAttrs'] ?> >
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
	<div class="<?= $options['choice_options']['wrapper']['class'] ?? 'form-check' ?>">
		<?php foreach ($options['choices'] as $value => $label) {
		    $id = $name.'_'.$value;
		    ?>
			<div class="<?= $options['choice_options']['field_wrapper']['class'] ?? 'form-check' ?>">
				<label class="form-check-label">
				<input type="checkbox" name="<?= $name.'[]' ?>"  value="<?= $value ?>" <?= in_array($value, (array) $options['selected']) ? 'checked="checked"' : '' ?>
				<?php
		        if (isset($options['choice_options']['attr'])) {
		            foreach ($options['choice_options']['attr'] as $attr => $val) { ?>
					<?php echo $attr.'="'.$val.'"'; ?>
				<?php }
		            } ?>
				/>
				<?= $label ?></label>
			</div>
		<?php } ?>
	</div>

	<?php include helpBlockPath(); ?>
<?php } ?>

<?php include errorBlockPath(); ?>

<?php if ($showLabel && $showField) { ?>
	<?php if ($options['wrapper'] !== false) { ?>
		</div>
	<?php } ?>
<?php } ?>
