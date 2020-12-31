<?php do_action('anahata_mikado_before_page_title'); ?>
<?php if($show_title_area) { ?>

    <div class="mkd-title <?php echo anahata_mikado_title_classes(); ?>" <?php anahata_mikado_inline_style($title_styles); ?> data-height="<?php echo esc_attr(intval(preg_replace('/[^0-9]+/', '', $title_height), 10)); ?>" <?php echo esc_attr($title_background_image_width); ?>>
        <div class="mkd-title-image"><?php if($title_background_image_src != "") { ?>
                <img src="<?php echo esc_url($title_background_image_src); ?>" alt="&nbsp;"/> <?php } ?>
        </div>
        <div class="mkd-title-holder" <?php anahata_mikado_inline_style($title_holder_height); ?>>
            <div class="mkd-container clearfix">
                <div class="mkd-container-inner">
                    <div class="mkd-title-subtitle-holder" style="<?php echo esc_attr($title_subtitle_holder_padding); ?>">
                        <div class="mkd-title-subtitle-holder-inner">
                            <?php switch($type) {
                                case 'standard': ?>
                                    <?php if($show_title_separator && $title_separator_icon !== '') { ?>
                                    <?php echo anahata_mikado_execute_shortcode('mkd_separator_with_icon', array(
                                        'custom_icon' => $title_separator_icon,
                                        'sep_color'   => $title_separator_color,
                                    )); ?>
                                    <?php } ?>
                                    <h1 <?php anahata_mikado_inline_style($title_color); ?>>
                                        <span><?php anahata_mikado_title_text(); ?></span></h1>
                                    <?php if($has_subtitle) { ?>
                                        <span class="mkd-subtitle" <?php anahata_mikado_inline_style($subtitle_color); ?>><span><?php anahata_mikado_subtitle_text(); ?></span></span>
                                    <?php } ?>
                                    <?php if($enable_breadcrumbs) { ?>
                                        <div class="mkd-breadcrumbs-holder"> <?php anahata_mikado_custom_breadcrumbs(); ?></div>
                                    <?php } ?>
                                    <?php break;
                                case 'breadcrumb': ?>
                                    <div class="mkd-breadcrumbs-holder"> <?php anahata_mikado_custom_breadcrumbs(); ?></div>
                                    <?php break;
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php } ?>
<?php do_action('anahata_mikado_after_page_title'); ?>