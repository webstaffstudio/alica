<div <?php anahata_mikado_class_attribute($holder_classes); ?>>
    <div class="mkd-iwt-icon-holder">
        <?php if(!empty($custom_icon)) : ?>
            <a class="mkd-iwt-link" href="<?php echo esc_url($link); ?>" <?php anahata_mikado_inline_attr($target, 'target'); ?>>
                <span class="mkd-iwt-custom-icon" <?php anahata_mikado_inline_style($custom_icon_styles); ?>><?php echo wp_get_attachment_image($custom_icon, 'full'); ?></span>
            </a>
        <?php else: ?>
            <a class="mkd-iwt-link" href="<?php echo esc_url($link); ?>" <?php anahata_mikado_inline_attr($target, 'target'); ?>>
                <?php echo mikado_core_get_core_shortcode_template_part('templates/icon', 'icon-with-text', '', array('icon_parameters' => $icon_parameters)); ?>
            </a>
        <?php endif; ?>
    </div>
    <div class="mkd-iwt-content-holder" <?php anahata_mikado_inline_style($content_styles); ?>>
        <div class="mkd-iwt-title-holder">
            <<?php echo esc_attr($title_tag); ?> <?php anahata_mikado_inline_style($title_styles); ?>><?php echo esc_html($title); ?></<?php echo esc_attr($title_tag); ?>>
    </div>
    <div class="mkd-iwt-text-holder">
        <p <?php anahata_mikado_inline_style($text_styles); ?>><?php echo esc_html($text); ?></p>
    </div>
</div>
</div>