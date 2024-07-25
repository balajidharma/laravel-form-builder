<?php if ($showLabel && $showField) { ?>
	<?php if ($options['wrapper'] !== false) { ?>
		<div <?php echo $options['wrapperAttrs'] ?> >
	<?php } ?>
<?php } ?>

<?php if ($showLabel && $options['label'] !== false && $options['label_show']) { ?>
	<?php echo Form::customLabel($name, $options['label'], $options['label_attr']) ?>
<?php } ?>

<?php if ($showField) { ?>
	<div class="form-checks">
		<?php foreach ($options['choices'] as $value => $label) {
		    $id = $name.'_'.$value;
		    ?>
			<div class="form-check">
				<?php echo Form::radio($name, $value, ! is_null($options['selected']) && $value == $options['selected'], ($options['option_attributes'][$value] ?? []) + ['id' => $id]); ?>
				<?php echo Form::label($id, $label); ?>
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
