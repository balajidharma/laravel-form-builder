<?php if ($showStart) { ?>
    <form action="<?= $formOptions['url'] ?>" method="<?= $formOptions['method'] ?>"
    <?php if (isset($formOptions['files'])) { ?>
        enctype="multipart/form-data"
    <?php } ?>
    <?= render_form_attributes($formOptions['attr'] ?? []); ?>
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
