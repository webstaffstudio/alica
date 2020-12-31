<div <?php anahata_mikado_class_attribute($separator_classes); ?>>

    <span class="mkd-separator-left" <?php echo anahata_mikado_get_inline_style($separator_style); ?>></span>

    <?php if(!empty($custom_icon)) : ?>
        <span class="mkd-sep-custom-image"><?php echo wp_get_attachment_image($custom_icon, 'full'); ?></span>
    <?php else: ?>
        <div class="mkd-icon-holder">
            <?php echo anahata_mikado_icon_collections()->renderIcon($icon, $icon_pack); ?>
        </div>
    <?php endif; ?>

    <span class="mkd-separator-right" <?php echo anahata_mikado_get_inline_style($separator_style); ?>></span>
</div>