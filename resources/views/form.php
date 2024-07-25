<?php if ($showStart): ?>
    <form action="<?= $formOptions['url'] ?>" method="<?= $formOptions['method'] ?>"
    <?php 
    if (isset($formOptions['attr'])):
    foreach ($formOptions['attr'] as $attr => $val): ?>
        <?php echo $attr . '="' . $val . '"'; ?>
    <?php endforeach; endif; ?>
    >
<?php endif; ?>

<?php if ($showFields): ?>
    <?php foreach ($fields as $field): ?>
    	<?php if( ! in_array($field->getName(), $exclude) ) { ?>
        	<?= $field->render() ?>
		<?php } ?>
    <?php endforeach; ?>
<?php endif; ?>

<?php if ($showEnd): ?>
    </form>
<?php endif; ?>
