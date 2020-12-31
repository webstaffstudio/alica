<div class="mkd-elements-holder-item <?php echo esc_attr($elements_holder_item_class); ?>" <?php echo anahata_mikado_get_inline_attrs($elements_holder_item_data); ?> <?php echo anahata_mikado_get_inline_style($elements_holder_item_style); ?>>
    <div class="mkd-elements-holder-item-inner">
        <div class="mkd-elements-holder-item-content <?php echo esc_attr($elements_holder_item_content_class); ?>" <?php echo anahata_mikado_get_inline_style($elements_holder_item_content_style); ?>>
            <?php echo do_shortcode($content); ?>
        </div>
    </div>
</div>