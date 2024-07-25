<?php if ($showLabel && $showField): ?>
	<?php if ($options['wrapper'] !== false): ?>
		<div <?php echo $options['wrapperAttrs'] ?> >
	<?php endif; ?>
<?php endif; ?>

<?php if ($showLabel && $options['label'] !== false && $options['label_show']): ?>
	<label for="<?= $name ?>"
    <?php  
    if (isset($options['label_attr'])):
    foreach ($options['label_attr'] as $attr => $val): ?>
        <?php echo $attr . '="' . $val . '"'; ?>
    <?php endforeach; endif; ?>
    ><?= $options['label'] ?></label>
<?php endif; ?>

<?php if ($showField): ?>
	<div class="<?= $options['choice_options']['wrapper']['class'] ?? 'form-check' ?>">
		<?php foreach ($options['choices'] as $value => $label):
			$id = $name . '_' . $value;
			?>
			<div class="<?= $options['choice_options']['field_wrapper']['class'] ?? 'form-check' ?>">
				<label class="form-check-label">
				<input type="checkbox" name="<?= $name. '[]' ?>"  value="<?= $value ?>" <?= in_array($value, (array) $options['selected']) ? 'checked="checked"' : '' ?>
				<?php 
				if (isset($options['choice_options']['attr'])):
				foreach ($options['choice_options']['attr'] as $attr => $val): ?>
					<?php echo $attr . '="' . $val . '"'; ?>
				<?php endforeach; endif; ?>
				/>
				<?= $label ?></label>
			</div>
		<?php endforeach; ?>
	</div>

	<?php include helpBlockPath(); ?>
<?php endif; ?>

<?php include errorBlockPath(); ?>

<?php if ($showLabel && $showField): ?>
	<?php if ($options['wrapper'] !== false): ?>
		</div>
	<?php endif; ?>
<?php endif; ?>
