<?php if ($showStart) { ?>
    <form action="<?= $formOptions['url'] ?>" method="<?= $formOptions['method'] ?>"
    <?php
    if (isset($formOptions['attr'])) {
        foreach ($formOptions['attr'] as $attr => $val) { ?>
        <?php echo $attr.'="'.$val.'"'; ?>
    <?php }
        } ?>
    >
<?php } ?>

<?php if ($showFields) { ?>
    <?php foreach ($fields as $field) { ?>
    	<?php if (! in_array($field->getName(), $exclude)) { ?>
        	<?= $field->render() ?>
		<?php } ?>
    <?php } ?>
<?php } ?>

<?php if ($showEnd) { ?>
    </form>
<?php } ?>
