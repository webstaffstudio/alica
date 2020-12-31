<?php get_header();

$mikado_bck_style = 'background-image: url('.esc_url(get_template_directory_uri().'/assets/img/error.png').')';
?>

    <div class="mkd-full-width">
        <?php do_action('anahata_mikado_after_container_open'); ?>
        <div class="mkd-full-width-inner mkd-404-page" <?php echo anahata_mikado_get_inline_style($mikado_bck_style); ?>>
            <div class="mkd-page-not-found">
                <div class="mkd-404-image">
                    <img src="<?php echo esc_url(get_template_directory_uri().'/assets/img/404.png') ?>" alt="<?php esc_attr_e('404', 'anahata'); ?>"/>
                </div>
                <h1>
                    <?php if(anahata_mikado_options()->getOptionValue('404_title')) {
                        echo esc_html(anahata_mikado_options()->getOptionValue('404_title'));
                    } else {
                        esc_html_e('Page not found', 'anahata');
                    } ?>
                </h1>
                <p>
                    <?php if(anahata_mikado_options()->getOptionValue('404_text')) {
                        echo esc_html(anahata_mikado_options()->getOptionValue('404_text'));
                    } else {
                        esc_html_e('The page you are looking for does not exist. It may have been moved, or removed altogether. Perhaps you can return back to the site\'s homepage and see if you can find what you are looking for.', 'anahata');
                    } ?>
                </p>
                <?php
                if(anahata_mikado_core_installed()) {
                    $params = array();
                    if(anahata_mikado_options()->getOptionValue('404_back_to_home')) {
                        $params['text'] = anahata_mikado_options()->getOptionValue('404_back_to_home');
                    } else {
                        $params['text'] = esc_html__('Back to Home', 'anahata');
                    }
                    $params['link']       = esc_url(home_url('/'));
                    $params['target']     = '_self';
                    $params['type']       = 'solid';
                    $params['hover_type'] = 'mkd-btn-hover-darken';
                    $params['margin']     = '35px 0px 35px 0px';
                    echo anahata_mikado_execute_shortcode('mkd_button', $params);
                }
                ?>
            </div>
        </div>
        <?php do_action('anahata_mikado_before_container_close'); ?>
    </div>
<?php wp_footer(); ?>