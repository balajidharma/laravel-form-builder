<?php if ($options['wrapper'] !== false) { ?>
    <div <?= $options['wrapperAttrs'] ?> >
<?php } ?>

    <?php if (! $options['splitted']) { ?>
        <div class="btn-group btn-group-<?= $options['size'] ?>">
    <?php } ?>

        <?php foreach ($options['buttons'] as $button) { ?>
            <?= Form::button($button['label'], $button['attr']) ?>
        <?php } ?>

    <?php if (! $options['splitted']) { ?>
        </div>
    <?php } ?>


<?php if ($options['wrapper'] !== false) { ?>
    </div>
<?php } ?>
