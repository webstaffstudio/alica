<?php
include_once get_template_directory().'/theme-includes.php';

if(!function_exists('anahata_mikado_styles')) {
    /**
     * Function that includes theme's core styles
     */
    function anahata_mikado_styles() {

        //include theme's core styles
        wp_enqueue_style('anahata-mikado-default-style', MIKADO_ROOT.'/style.css');
        wp_enqueue_style('anahata-mikado-modules-plugins', MIKADO_ASSETS_ROOT.'/css/plugins.min.css');

        wp_enqueue_style('wp-mediaelement');

        //is woocommerce installed?
        if(anahata_mikado_is_woocommerce_installed()) {
            if(anahata_mikado_load_woo_assets()) {
                //include theme's woocommerce styles
                wp_enqueue_style('anahata-mikado-woocommerce', MIKADO_ASSETS_ROOT.'/css/woocommerce.min.css');
            }
        }

        wp_enqueue_style('anahata-mikado-modules', MIKADO_ASSETS_ROOT.'/css/modules.min.css');

        wp_enqueue_style('anahata-mikado-blog', MIKADO_ASSETS_ROOT.'/css/blog.min.css');

        anahata_mikado_icon_collections()->enqueueStyles();


        //define files afer which style dynamic needs to be included. It should be included last so it can override other files
        $style_dynamic_deps_array = array();
        if(anahata_mikado_load_woo_assets() || anahata_mikado_is_ajax_enabled()) {
            $style_dynamic_deps_array = array('anahata-mikado-woocommerce', 'anahata-mikado-woocommerce-responsive');
        }

        if(file_exists(MIKADO_ROOT_DIR.'/assets/css/style_dynamic.css') && anahata_mikado_is_css_folder_writable() && !is_multisite()) {
            wp_enqueue_style('anahata-mikado-style-dynamic', MIKADO_ASSETS_ROOT.'/css/style_dynamic.css', $style_dynamic_deps_array, filemtime(MIKADO_ROOT_DIR.'/assets/css/style_dynamic.css')); //it must be included after woocommerce styles so it can override it
        }

        //is responsive option turned on?
        if(anahata_mikado_is_responsive_on()) {
            wp_enqueue_style('anahata-mikado-modules-responsive', MIKADO_ASSETS_ROOT.'/css/modules-responsive.min.css');
            wp_enqueue_style('anahata-mikado-blog-responsive', MIKADO_ASSETS_ROOT.'/css/blog-responsive.min.css');

            //is woocommerce installed?
            if(anahata_mikado_is_woocommerce_installed()) {
                if(anahata_mikado_load_woo_assets()) {
                    //include theme's woocommerce responsive styles
                    wp_enqueue_style('anahata-mikado-woocommerce-responsive', MIKADO_ASSETS_ROOT.'/css/woocommerce-responsive.min.css');
                }
            }

            //include proper styles
            if(file_exists(MIKADO_ROOT_DIR.'/assets/css/style_dynamic_responsive.css') && anahata_mikado_is_css_folder_writable() && !is_multisite()) {
                wp_enqueue_style('anahata-mikado-style-dynamic-responsive', MIKADO_ASSETS_ROOT.'/css/style_dynamic_responsive.css', array(), filemtime(MIKADO_ROOT_DIR.'/assets/css/style_dynamic_responsive.css'));
            }
        }

        //include Visual Composer styles
        if(class_exists('WPBakeryVisualComposerAbstract')) {
            wp_enqueue_style('js_composer_front');
        }

    }

    add_action('wp_enqueue_scripts', 'anahata_mikado_styles');
}

if(!function_exists('anahata_mikado_google_fonts_styles')) {
    /**
     * Function that includes google fonts defined anywhere in the theme
     */
    function anahata_mikado_google_fonts_styles() {
        $font_simple_field_array = anahata_mikado_options()->getOptionsByType('fontsimple');
        if(!(is_array($font_simple_field_array) && count($font_simple_field_array) > 0)) {
            $font_simple_field_array = array();
        }

        $font_field_array = anahata_mikado_options()->getOptionsByType('font');
        if(!(is_array($font_field_array) && count($font_field_array) > 0)) {
            $font_field_array = array();
        }

        $available_font_options = array_merge($font_simple_field_array, $font_field_array);
        $font_weight_str        = '100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic';

        //define available font options array
        $fonts_array = array();
        foreach($available_font_options as $font_option) {
            //is font set and not set to default and not empty?
            $font_option_value = anahata_mikado_options()->getOptionValue($font_option);
            if(anahata_mikado_is_font_option_valid($font_option_value) && !anahata_mikado_is_native_font($font_option_value)) {
                $font_option_string = $font_option_value.':'.$font_weight_str;
                if(!in_array($font_option_string, $fonts_array)) {
                    $fonts_array[] = $font_option_string;
                }
            }
        }

        wp_reset_postdata();

        $fonts_array         = array_diff($fonts_array, array('-1:'.$font_weight_str));
        $google_fonts_string = implode('|', $fonts_array);

        //default fonts should be separated with %7C because of HTML validation
        $default_font_string = 'Open Sans:'.$font_weight_str.'|Raleway:'.$font_weight_str;
        $protocol            = is_ssl() ? 'https:' : 'http:';

        //is google font option checked anywhere in theme?
        if(count($fonts_array) > 0) {

            //include all checked fonts
            $fonts_full_list      = $default_font_string.'|'.str_replace('+', ' ', $google_fonts_string);
            $fonts_full_list_args = array(
                'family' => urlencode($fonts_full_list),
                'subset' => urlencode('latin,latin-ext'),
            );

            $anahata_fonts = add_query_arg($fonts_full_list_args, $protocol.'//fonts.googleapis.com/css');
            wp_enqueue_style('anahata-mikado-google-fonts', esc_url_raw($anahata_fonts), array(), '1.0.0');

        } else {
            //include default google font that theme is using
            $default_fonts_args = array(
                'family' => urlencode($default_font_string),
                'subset' => urlencode('latin,latin-ext'),
            );
            $anahata_fonts      = add_query_arg($default_fonts_args, $protocol.'//fonts.googleapis.com/css');
            wp_enqueue_style('anahata-mikado-google-fonts', esc_url_raw($anahata_fonts), array(), '1.0.0');
        }

    }

    add_action('wp_enqueue_scripts', 'anahata_mikado_google_fonts_styles');
}

if(!function_exists('anahata_mikado_scripts')) {
    /**
     * Function that includes all necessary scripts
     */
    function anahata_mikado_scripts() {
        global $wp_scripts;

        //init theme core scripts
        wp_enqueue_script('jquery-ui-core');
        wp_enqueue_script('jquery-ui-tabs');
        wp_enqueue_script('jquery-ui-accordion');
        wp_enqueue_script('wp-mediaelement');

		// 3rd party JavaScripts that we used in our theme
		wp_enqueue_script( 'appear', MIKADO_ASSETS_ROOT . '/js/modules/plugins/jquery.appear.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'modernizr', MIKADO_ASSETS_ROOT . '/js/modules/plugins/modernizr.custom.85257.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'hoverIntent', MIKADO_ASSETS_ROOT . '/js/modules/plugins/jquery.hoverIntent.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'jquery-plugin', MIKADO_ASSETS_ROOT . '/js/modules/plugins/jquery.plugin.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'countdown', MIKADO_ASSETS_ROOT . '/js/modules/plugins/jquery.countdown.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'owl-carousel', MIKADO_ASSETS_ROOT . '/js/modules/plugins/owl.carousel.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'parallax', MIKADO_ASSETS_ROOT . '/js/modules/plugins/parallax.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'select-2', MIKADO_ASSETS_ROOT . '/js/modules/plugins/select2.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'easypiechart', MIKADO_ASSETS_ROOT . '/js/modules/plugins/easypiechart.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'waypoints', MIKADO_ASSETS_ROOT . '/js/modules/plugins/jquery.waypoints.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'Chart', MIKADO_ASSETS_ROOT . '/js/modules/plugins/Chart.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'counter', MIKADO_ASSETS_ROOT . '/js/modules/plugins/counter.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'absoluteCounter', MIKADO_ASSETS_ROOT . '/js/modules/plugins/absoluteCounter.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'fluidvids', MIKADO_ASSETS_ROOT . '/js/modules/plugins/fluidvids.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'prettyPhoto', MIKADO_ASSETS_ROOT . '/js/modules/plugins/jquery.prettyPhoto.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'nicescroll', MIKADO_ASSETS_ROOT . '/js/modules/plugins/jquery.nicescroll.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'ScrollToPlugin', MIKADO_ASSETS_ROOT . '/js/modules/plugins/ScrollToPlugin.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'TweenLite', MIKADO_ASSETS_ROOT . '/js/modules/plugins/TweenLite.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'TimelineLite', MIKADO_ASSETS_ROOT . '/js/modules/plugins/TimelineLite.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'CSSPlugin', MIKADO_ASSETS_ROOT . '/js/modules/plugins/CSSPlugin.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'EasePack', MIKADO_ASSETS_ROOT . '/js/modules/plugins/EasePack.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'mixitup', MIKADO_ASSETS_ROOT . '/js/modules/plugins/jquery.mixitup.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'waitforimages', MIKADO_ASSETS_ROOT . '/js/modules/plugins/jquery.waitforimages.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'infinitescroll', MIKADO_ASSETS_ROOT . '/js/modules/plugins/jquery.infinitescroll.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'jquery-easing-1.3', MIKADO_ASSETS_ROOT . '/js/modules/plugins/jquery.easing.1.3.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'skrollr', MIKADO_ASSETS_ROOT . '/js/modules/plugins/skrollr.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'bootstrapCarousel', MIKADO_ASSETS_ROOT . '/js/modules/plugins/bootstrapCarousel.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'slick', MIKADO_ASSETS_ROOT . '/js/modules/plugins/slick.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'touchSwipe', MIKADO_ASSETS_ROOT . '/js/modules/plugins/jquery.touchSwipe.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'multiscroll', MIKADO_ASSETS_ROOT . '/js/modules/plugins/jquery.multiscroll.min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'flexslider-min', MIKADO_ASSETS_ROOT . '/js/modules/plugins/jquery.flexslider-min.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'carouFredSel', MIKADO_ASSETS_ROOT . '/js/modules/plugins/jquery.carouFredSel-6.2.1.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'hoverdir', MIKADO_ASSETS_ROOT . '/js/modules/plugins/jquery.hoverdir.js', array( 'jquery' ), false, true );
        wp_enqueue_script( 'isotope', MIKADO_ASSETS_ROOT.'/js/modules/plugins/isotope.pkgd.min.js', array('jquery'), false, true);
        wp_enqueue_script( 'packery-mode', MIKADO_ASSETS_ROOT.'/js/modules/plugins/packery-mode.pkgd.min.js', array('isotope'), false, true);

        if(anahata_mikado_is_smoth_scroll_enabled()) {
            wp_enqueue_script("anahata-mikado-smooth-page-scroll", MIKADO_ASSETS_ROOT."/js/smoothPageScroll.js", array(), false, true);
        }

        //include google map api script
        $google_maps_api_key = anahata_mikado_options()->getOptionValue('google_maps_api_key');
        if($google_maps_api_key !== '') {
            wp_enqueue_script('google-map-api', '//maps.googleapis.com/maps/api/js?key='.$google_maps_api_key, array(), false, true);
        }

        wp_enqueue_script('anahata-mikado-modules', MIKADO_ASSETS_ROOT.'/js/modules.min.js', array('jquery'), false, true);

        wp_enqueue_script('anahata-mikado-blog', MIKADO_ASSETS_ROOT.'/js/blog.min.js', array('jquery'), false, true);

        //include comment reply script
        $wp_scripts->add_data('comment-reply', 'group', 1);
        if(is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script("comment-reply");
        }

        //include Visual Composer script
        if(class_exists('WPBakeryVisualComposerAbstract')) {
            wp_enqueue_script('wpb_composer_front_js');
        }
    }

    add_action('wp_enqueue_scripts', 'anahata_mikado_scripts');
}

if(!function_exists('anahata_mikado_is_ajax_enabled')) {
    /**
     * Function that checks if ajax is enabled
     */
    function anahata_mikado_is_ajax_enabled() {

        return anahata_mikado_options()->getOptionValue('smooth_page_transitions') === 'yes' && anahata_mikado_options()->getOptionValue('smooth_pt_true_ajax') === 'yes';

    }
}

if(!function_exists('anahata_mikado_ajax_meta')) {
    /**
     * Function that echoes meta data for ajax
     *
     * @since 4.3
     * @version 0.2
     */
    function anahata_mikado_ajax_meta() {

        $id = anahata_mikado_get_page_id();

        $page_transition = get_post_meta($id, "mkd_page_transition_type", true);
        ?>

        <div class="mkd-seo-title"><?php echo wp_get_document_title(); ?></div>

        <?php if($page_transition !== '') { ?>
            <div class="mkd-page-transition"><?php echo esc_html($page_transition); ?></div>
        <?php } else if(anahata_mikado_options()->getOptionValue('default_page_transition')) { ?>
            <div class="mkd-page-transition"><?php echo esc_html(anahata_mikado_options()->getOptionValue('default_page_transition')); ?></div>
        <?php }
    }

    add_action('anahata_mikado_ajax_meta', 'anahata_mikado_ajax_meta');
}

if(!function_exists('anahata_mikado_no_ajax_pages')) {
    /**
     * Function that echoes pages on which ajax should not be applied
     *
     * @since 4.3
     * @version 0.2
     */
    function anahata_mikado_no_ajax_pages($global_variables) {

        //is ajax enabled?
        if(anahata_mikado_is_ajax_enabled()) {
            $no_ajax_pages = array();

            //get posts that have ajax disabled and merge with main array
            $no_ajax_pages = array_merge($no_ajax_pages, anahata_mikado_get_objects_without_ajax());

            //is wpml installed?
            if(anahata_mikado_is_wpml_installed()) {
                //get translation pages for current page and merge with main array
                $no_ajax_pages = array_merge($no_ajax_pages, anahata_mikado_get_wpml_pages_for_current_page());
            }

            //is woocommerce installed?
            if(anahata_mikado_is_woocommerce_installed()) {
                //get all woocommerce pages and products and merge with main array
                $no_ajax_pages = array_merge($no_ajax_pages, anahata_mikado_get_woocommerce_pages());
            }
            //do we have some internal pages that want to be without ajax?
            if(anahata_mikado_options()->getOptionValue('internal_no_ajax_links') !== '') {
                //get array of those pages
                $options_no_ajax_pages_array = explode(',', anahata_mikado_options()->getOptionValue('internal_no_ajax_links'));

                if(is_array($options_no_ajax_pages_array) && count($options_no_ajax_pages_array)) {
                    $no_ajax_pages = array_merge($no_ajax_pages, $options_no_ajax_pages_array);
                }
            }

            //add logout url to main array
            $no_ajax_pages[] = wp_specialchars_decode(wp_logout_url());

            $global_variables['no_ajax_pages'] = $no_ajax_pages;
        }

        return $global_variables;
    }

    add_filter('anahata_mikado_js_global_variables', 'anahata_mikado_no_ajax_pages');
}

if(!function_exists('anahata_mikado_get_objects_without_ajax')) {
    /**
     * Function that returns urls of objects that have ajax disabled.
     * Works for posts, pages and portfolio pages.
     * @return array array of urls of posts that have ajax disabled
     *
     * @version 0.1
     */
    function anahata_mikado_get_objects_without_ajax() {
        $posts_without_ajax = array();

        $posts_args = array(
            'post_type'   => array('post', 'portfolio-item', 'page'),
            'post_status' => 'publish',
            'meta_key'    => 'mkd_page_transition_type',
            'meta_value'  => 'no-animation'
        );

        $posts_query = new WP_Query($posts_args);

        if($posts_query->have_posts()) {
            while($posts_query->have_posts()) {
                $posts_query->the_post();
                $posts_without_ajax[] = get_permalink(get_the_ID());
            }
        }

        wp_reset_postdata();

        return $posts_without_ajax;
    }
}


//defined content width variable
if(!isset($content_width)) {
    $content_width = 1060;
}

if(!function_exists('anahata_mikado_theme_setup')) {
    /**
     * Function that adds various features to theme. Also defines image sizes that are used in a theme
     */
    function anahata_mikado_theme_setup() {
        //add support for feed links
        add_theme_support('automatic-feed-links');

        //add support for post formats
        add_theme_support('post-formats', array('gallery', 'link', 'quote', 'video', 'audio'));

        //add theme support for post thumbnails
        add_theme_support('post-thumbnails');

        //add theme support for title tag
        add_theme_support('title-tag');


        //define thumbnail sizes
        add_image_size('anahata_mikado_square', 650, 650, true);
        add_image_size('anahata_mikado_landscape', 800, 600, true);
        add_image_size('anahata_mikado_portrait', 600, 800, true);
        add_image_size('anahata_mikado_masonry', 800, 460, true);
        add_image_size('anahata_mikado_large_width', 1125, 550, true);
        add_image_size('anahata_mikado_large_height', 550, 1125, true);
        add_image_size('anahata_mikado_large_width_height', 1125, 1125, true);

        load_theme_textdomain('anahata', get_template_directory().'/languages');
    }

    add_action('after_setup_theme', 'anahata_mikado_theme_setup');
}

if ( ! function_exists( 'anahata_mikado_enqueue_editor_customizer_styles' ) ) {
	/**
	 * Enqueue supplemental block editor styles
	 */
	function anahata_mikado_enqueue_editor_customizer_styles() {
		wp_enqueue_style( 'anahata-style-modules-admin-styles', MIKADO_FRAMEWORK_ADMIN_ASSETS_ROOT . '/css/mkd-modules-admin.css' );
		wp_enqueue_style( 'anahata-style-handle-editor-customizer-styles', MIKADO_FRAMEWORK_ADMIN_ASSETS_ROOT . '/css/editor-customizer-style.css' );
	}

	// add google font
	add_action( 'enqueue_block_editor_assets', 'anahata_mikado_google_fonts_styles' );
	// add action
	add_action( 'enqueue_block_editor_assets', 'anahata_mikado_enqueue_editor_customizer_styles' );
}

if(!function_exists('anahata_mikado_rgba_color')) {
    /**
     * Function that generates rgba part of css color property
     *
     * @param $color string hex color
     * @param $transparency float transparency value between 0 and 1
     *
     * @return string generated rgba string
     */
    function anahata_mikado_rgba_color($color, $transparency) {
        if($color !== '' && $transparency !== '') {
            $rgba_color = '';

            $rgb_color_array = anahata_mikado_hex2rgb($color);
            $rgba_color .= 'rgba('.implode(', ', $rgb_color_array).', '.$transparency.')';

            return $rgba_color;
        }
    }
}

if(!function_exists('anahata_mikado_header_meta')) {
    /**
     * Function that echoes meta data if our seo is enabled
     */
    function anahata_mikado_header_meta() { ?>
        <meta charset="<?php bloginfo('charset'); ?>"/>
        <link rel="profile" href="http://gmpg.org/xfn/11"/>
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
    <?php }

    add_action('anahata_mikado_header_meta', 'anahata_mikado_header_meta');
}

if(!function_exists('anahata_mikado_user_scalable_meta')) {
    /**
     * Function that outputs user scalable meta if responsiveness is turned on
     * Hooked to anahata_mikado_header_meta action
     */
    function anahata_mikado_user_scalable_meta() {
        //is responsiveness option is chosen?
        if(anahata_mikado_is_responsive_on()) { ?>
            <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
        <?php } else { ?>
            <meta name="viewport" content="width=1200,user-scalable=no">
        <?php }
    }

    add_action('anahata_mikado_header_meta', 'anahata_mikado_user_scalable_meta');
}

if(!function_exists('anahata_mikado_get_page_id')) {
    /**
     * Function that returns current page / post id.
     * Checks if current page is woocommerce page and returns that id if it is.
     * Checks if current page is any archive page (category, tag, date, author etc.) and returns -1 because that isn't
     * page that is created in WP admin.
     *
     * @return int
     *
     * @version 0.1
     *
     * @see anahata_mikado_is_woocommerce_installed()
     * @see anahata_mikado_is_woocommerce_shop()
     */
    function anahata_mikado_get_page_id() {
        if(anahata_mikado_is_woocommerce_installed() && anahata_mikado_is_woocommerce_shop()) {
            return anahata_mikado_get_woo_shop_page_id();
        }

        if(is_archive() || is_search() || is_404() || (is_home() && is_front_page())) {
            return -1;
        }

        return get_queried_object_id();
    }
}


if(!function_exists('anahata_mikado_is_default_wp_template')) {
    /**
     * Function that checks if current page archive page, search, 404 or default home blog page
     * @return bool
     *
     * @see is_archive()
     * @see is_search()
     * @see is_404()
     * @see is_front_page()
     * @see is_home()
     */
    function anahata_mikado_is_default_wp_template() {
        return is_archive() || is_search() || is_404() || (is_front_page() && is_home());
    }
}

if(!function_exists('anahata_mikado_has_shortcode')) {
    /**
     * Function that checks whether shortcode exists on current page / post
     *
     * @param string shortcode to find
     * @param string content to check. If isn't passed current post content will be used
     *
     * @return bool whether content has shortcode or not
     */
    function anahata_mikado_has_shortcode($shortcode, $content = '') {
        $has_shortcode = false;

        if($shortcode) {
            //if content variable isn't past
            if($content == '') {
                //take content from current post
                $page_id = anahata_mikado_get_page_id();
                if(!empty($page_id)) {
                    $current_post = get_post($page_id);

                    if(is_object($current_post) && property_exists($current_post, 'post_content')) {
                        $content = $current_post->post_content;
                    }
                }
            }

            //does content has shortcode added?
            if(stripos($content, '['.$shortcode) !== false) {
                $has_shortcode = true;
            }
        }

        return $has_shortcode;
    }
}

if(!function_exists('anahata_mikado_get_sidebar')) {
    /**
     * Return Sidebar
     *
     * @return string
     */
    function anahata_mikado_get_sidebar() {

        $id = anahata_mikado_get_page_id();

        $sidebar = "sidebar";

        if(get_post_meta($id, 'mkd_custom_sidebar_meta', true) != '') {
            $sidebar = get_post_meta($id, 'mkd_custom_sidebar_meta', true);
        } else {
            if(is_single() && anahata_mikado_options()->getOptionValue('blog_single_custom_sidebar') != '') {
                $sidebar = esc_attr(anahata_mikado_options()->getOptionValue('blog_single_custom_sidebar'));
            } elseif((is_archive() || (is_home() && is_front_page())) && anahata_mikado_options()->getOptionValue('blog_custom_sidebar') != '') {
                $sidebar = esc_attr(anahata_mikado_options()->getOptionValue('blog_custom_sidebar'));
            } elseif(is_page() && anahata_mikado_options()->getOptionValue('page_custom_sidebar') != '') {
                $sidebar = esc_attr(anahata_mikado_options()->getOptionValue('page_custom_sidebar'));
            }
        }
        if ( is_archive() && ( is_product_category() || is_product_tag() ) ) {
            $shop_id = anahata_mikado_get_woo_shop_page_id();
            if (get_post_meta($shop_id, 'mkd_custom_sidebar_meta', true) != '') {
                $sidebar = get_post_meta( $shop_id, 'mkd_custom_sidebar_meta', true );
            }
        }

        return apply_filters('anahata_mikado_sidebar', $sidebar);
    }
}

if(!function_exists('anahata_mikado_move_comment_field_to_bottom')) {
    function anahata_mikado_move_comment_field_to_bottom($fields) {
        $comment_field = $fields['comment'];
		$cookies_field = $fields['cookies'];

		unset($fields['comment']);
        $fields['comment'] = $comment_field;

		unset($fields['cookies']);
		$fields['cookies'] = $cookies_field;

		return $fields;
    }

    add_filter('comment_form_fields', 'anahata_mikado_move_comment_field_to_bottom');
}

if(!function_exists('anahata_mikado_sidebar_columns_class')) {

    /**
     * Return classes for columns holder when sidebar is active
     *
     * @return array
     */

    function anahata_mikado_sidebar_columns_class() {

        $sidebar_class  = array();
        $sidebar_layout = anahata_mikado_sidebar_layout();

        switch($sidebar_layout):
            case 'sidebar-33-right':
                $sidebar_class[] = 'mkd-two-columns-66-33';
                break;
            case 'sidebar-25-right':
                $sidebar_class[] = 'mkd-two-columns-75-25';
                break;
            case 'sidebar-33-left':
                $sidebar_class[] = 'mkd-two-columns-33-66';
                break;
            case 'sidebar-25-left':
                $sidebar_class[] = 'mkd-two-columns-25-75';
                break;

        endswitch;

        $sidebar_class[] = 'clearfix';

        return anahata_mikado_class_attribute($sidebar_class);

    }
}

if(!function_exists('anahata_mikado_get_content_sidebar_class')) {
    /**
     * @return string
     */
    function anahata_mikado_get_content_sidebar_class() {
        $sidebar_layout = anahata_mikado_sidebar_layout();
        $content_class  = array('mkd-page-content-holder');

        switch($sidebar_layout) {
            case 'sidebar-33-right':
                $content_class[] = 'mkd-grid-col-8';
                break;
            case 'sidebar-25-right':
                $content_class[] = 'mkd-grid-col-9';
                break;
            case 'sidebar-33-left':
                $content_class[] = 'mkd-grid-col-8';
                $content_class[] = 'mkd-grid-col-push-4';
                break;
            case 'sidebar-25-left':
                $content_class[] = 'mkd-grid-col-9';
                $content_class[] = 'mkd-grid-col-push-3';
                break;
            default:
                $content_class[] = 'mkd-grid-col-12';
                break;
        }

        return anahata_mikado_get_class_attribute($content_class);
    }
}

if(!function_exists('anahata_mikado_get_sidebar_holder_class')) {
    /**
     * @return string
     */
    function anahata_mikado_get_sidebar_holder_class() {
        $sidebar_layout = anahata_mikado_sidebar_layout();
        $sidebar_class  = array('mkd-sidebar-holder');

        switch($sidebar_layout) {
            case 'sidebar-33-right':
                $sidebar_class[] = 'mkd-grid-col-4';
                break;
            case 'sidebar-25-right':
                $sidebar_class[] = 'mkd-grid-col-3';
                break;
            case 'sidebar-33-left':
                $sidebar_class[] = 'mkd-grid-col-4';
                $sidebar_class[] = 'mkd-grid-col-pull-8';
                break;
            case 'sidebar-25-left':
                $sidebar_class[] = 'mkd-grid-col-3';
                $sidebar_class[] = 'mkd-grid-col-pull-9';
                break;
        }

        return anahata_mikado_get_class_attribute($sidebar_class);
    }
}


if(!function_exists('anahata_mikado_sidebar_layout')) {

    /**
     * Function that check is sidebar is enabled and return type of sidebar layout
     */

    function anahata_mikado_sidebar_layout() {

        $sidebar_layout = '';
        $page_id        = anahata_mikado_get_page_id();

        $page_sidebar_meta = get_post_meta($page_id, 'mkd_sidebar_meta', true);

        if(($page_sidebar_meta !== '') && $page_id !== -1) {
            $sidebar_layout = $page_sidebar_meta !== 'no-sidebar' ? $page_sidebar_meta : '';
        } else {
            if(is_single() && anahata_mikado_options()->getOptionValue('blog_single_sidebar_layout')) {
                $sidebar_layout = esc_attr(anahata_mikado_options()->getOptionValue('blog_single_sidebar_layout'));
            } elseif((is_archive() || is_search() || (is_home() && is_front_page())) && anahata_mikado_options()->getOptionValue('archive_sidebar_layout')) {
                $sidebar_layout = esc_attr(anahata_mikado_options()->getOptionValue('archive_sidebar_layout'));
            } elseif(is_page() && anahata_mikado_options()->getOptionValue('page_sidebar_layout')) {
                $sidebar_layout = esc_attr(anahata_mikado_options()->getOptionValue('page_sidebar_layout'));
            } elseif(! empty( $sidebar_layout ) && ! is_active_sidebar( anahata_mikado_get_sidebar() ) ) {
				$sidebar_layout = '';
			}
        }
        if ( is_archive() && ( is_product_category() || is_product_tag() ) ) {
            $shop_id = anahata_mikado_get_woo_shop_page_id();
            if (get_post_meta($shop_id, 'mkd_sidebar_meta', true) != '') {
                $sidebar_layout = get_post_meta( $shop_id, 'mkd_sidebar_meta', true );
            }
        }

        return apply_filters('anahata_mikado_sidebar_layout', $sidebar_layout);
    }
}

if(!function_exists('anahata_mikado_page_custom_style')) {

	/**
	 * Function that print custom page style
	 */

	function anahata_mikado_page_custom_style() {
		$html  = '';
		$style = apply_filters('anahata_mikado_add_page_custom_style', $style = array());
		if(is_array($style) && count($style)) {
			$html .= implode(' ', $style);
			wp_add_inline_style('anahata-mikado-modules', $html);
		}
	}
}

if(!function_exists('anahata_mikado_register_page_custom_style')) {

    /**
     * Function that print custom page style
     */

    function anahata_mikado_register_page_custom_style() {
        add_action((anahata_mikado_is_ajax_enabled() && anahata_mikado_is_ajax_request()) ? 'anahata_mikado_ajax_meta' : 'wp_enqueue_scripts', 'anahata_mikado_page_custom_style');
    }

    add_action('anahata_mikado_after_options_map', 'anahata_mikado_register_page_custom_style');
}

if(!function_exists('anahata_mikado_container_style')) {

    /**
     * Function that return container style
     */

    function anahata_mikado_container_style($style) {
        $id           = anahata_mikado_get_page_id();
        $class_prefix = anahata_mikado_get_unique_page_class();

        $container_selector = array(
            $class_prefix.' .mkd-content .mkd-content-inner > .mkd-container',
            $class_prefix.' .mkd-content .mkd-content-inner > .mkd-full-width',
        );

        $container_class       = array();
        $page_backgorund_color = get_post_meta($id, "mkd_page_background_color_meta", true);

        if($page_backgorund_color) {
            $container_class['background-color'] = $page_backgorund_color;
        }

        $current_style = anahata_mikado_dynamic_css($container_selector, $container_class);
        $style[]       = $current_style;

        return $style;
    }

    add_filter('anahata_mikado_add_page_custom_style', 'anahata_mikado_container_style');
}

if(!function_exists('anahata_mikado_get_unique_page_class')) {
    /**
     * Returns unique page class based on post type and page id
     *
     * @return string
     */
    function anahata_mikado_get_unique_page_class() {
        $id         = anahata_mikado_get_page_id();
        $page_class = '';

        if(is_single()) {
            $page_class = '.postid-'.get_queried_object_id();
        } elseif($id === anahata_mikado_get_woo_shop_page_id()) {
            $page_class = '.archive';
        } elseif(is_home()) {
            $page_class .= '.home';
        } else {
            $page_class .= '.page-id-'.$id;
        }

        return $page_class;
    }
}

if(!function_exists('anahata_mikado_page_padding')) {

    /**
     * Function that return container style
     */

    function anahata_mikado_page_padding($style) {

        $id           = anahata_mikado_get_page_id();
        $class_prefix = anahata_mikado_get_unique_page_class();

        $page_selector = array(
            $class_prefix.' .mkd-content .mkd-content-inner > .mkd-container > .mkd-container-inner',
            $class_prefix.' .mkd-content .mkd-content-inner > .mkd-full-width > .mkd-full-width-inner'
        );
        $page_css      = array();

        $page_padding = get_post_meta($id, 'mkd_page_padding_meta', true);

        if($page_padding !== '') {
            $page_css['padding'] = $page_padding;
        }

        $current_style = anahata_mikado_dynamic_css($page_selector, $page_css);

        $style[] = $current_style;

        return $style;

    }

    add_filter('anahata_mikado_add_page_custom_style', 'anahata_mikado_page_padding');
}

if(!function_exists('anahata_mikado_print_custom_css')) {
    /**
     * Prints out custom css from theme options
     */
    function anahata_mikado_print_custom_css() {
        $custom_css = anahata_mikado_options()->getOptionValue('custom_css');

        if($custom_css !== '') {
            wp_add_inline_style('anahata-mikado-modules', $custom_css);
        }
    }

    add_action('wp_enqueue_scripts', 'anahata_mikado_print_custom_css');
}

if(!function_exists('anahata_mikado_print_custom_js')) {
    /**
     * Prints out custom css from theme options
     */
    function anahata_mikado_print_custom_js() {
        $custom_js = anahata_mikado_options()->getOptionValue('custom_js');

        if($custom_js !== '') {
            wp_add_inline_script('anahata-mikado-modules', $custom_js);
        }
    }

    add_action('wp_enqueue_scripts', 'anahata_mikado_print_custom_js');
}


if(!function_exists('anahata_mikado_get_global_variables')) {
    /**
     * Function that generates global variables and put them in array so they could be used in the theme
     */
    function anahata_mikado_get_global_variables() {

        $global_variables      = array();
        $element_appear_amount = -150;

        $global_variables['mkdAddForAdminBar']      = is_admin_bar_showing() ? 32 : 0;
        $global_variables['mkdElementAppearAmount'] = anahata_mikado_options()->getOptionValue('element_appear_amount') !== '' ? anahata_mikado_options()->getOptionValue('element_appear_amount') : $element_appear_amount;
        $global_variables['mkdFinishedMessage']     = esc_html__('No more posts', 'anahata');
        $global_variables['mkdMessage']             = esc_html__('Loading new posts...', 'anahata');

        $global_variables = apply_filters('anahata_mikado_js_global_variables', $global_variables);

        wp_localize_script('anahata-mikado-modules', 'mkdGlobalVars', array(
            'vars' => $global_variables
        ));

    }

    add_action('wp_enqueue_scripts', 'anahata_mikado_get_global_variables');
}

if(!function_exists('anahata_mikado_per_page_js_variables')) {
    /**
     * Outputs global JS variable that holds page settings
     */
    function anahata_mikado_per_page_js_variables() {
        $per_page_js_vars = apply_filters('anahata_mikado_per_page_js_vars', array());

        wp_localize_script('anahata-mikado-modules', 'mkdPerPageVars', array(
            'vars' => $per_page_js_vars
        ));
    }

    add_action('wp_enqueue_scripts', 'anahata_mikado_per_page_js_variables');
}

if(!function_exists('anahata_mikado_content_elem_style_attr')) {
    /**
     * Defines filter for adding custom styles to content HTML element
     */
    function anahata_mikado_content_elem_style_attr() {
        $styles = apply_filters('anahata_mikado_content_elem_style_attr', array());

        anahata_mikado_inline_style($styles);
    }
}

if(!function_exists('anahata_mikado_is_woocommerce_installed')) {
    /**
     * Function that checks if woocommerce is installed
     * @return bool
     */
    function anahata_mikado_is_woocommerce_installed() {
        return function_exists('is_woocommerce');
    }
}

if(!function_exists('anahata_mikado_visual_composer_installed')) {
    /**
     * Function that checks if visual composer installed
     * @return bool
     */
    function anahata_mikado_visual_composer_installed() {
        //is Visual Composer installed?
        if(class_exists('WPBakeryVisualComposerAbstract')) {
            return true;
        }

        return false;
    }
}

if(!function_exists('anahata_mikado_timetable_schedule_installed')) {
    /**
     * Checks if Timetable Responsive Schedule plugin is installed
     */
    function anahata_mikado_timetable_schedule_installed() {
        //checking for this dummy function because plugin doesn't have constant or class
        //that we can hook to. Poorly coded plugin
        return function_exists('timetable_load_textdomain');
    }
}

if(!function_exists('anahata_mikado_the_events_calendar_installed')) {
    /**
     * Checks whether The Event Calendar plugins is installed
     * @return bool
     */
    function anahata_mikado_the_events_calendar_installed() {
        return class_exists('Tribe__Events__Main');
    }
}

if(!function_exists('anahata_mikado_contact_form_7_installed')) {
    /**
     * Function that checks if contact form 7 installed
     * @return bool
     */
    function anahata_mikado_contact_form_7_installed() {
        //is Contact Form 7 installed?
        if(defined('WPCF7_VERSION')) {
            return true;
        }

        return false;
    }
}

if(!function_exists('anahata_mikado_is_wpml_installed')) {
    /**
     * Function that checks if WPML plugin is installed
     * @return bool
     *
     * @version 0.1
     */
    function anahata_mikado_is_wpml_installed() {
        return defined('ICL_SITEPRESS_VERSION');
    }
}

if ( ! function_exists( 'anahata_mikado_is_plugin_installed' ) ) {
	/**
	 * Function that checks if forward plugin installed
	 *
	 * @param $plugin string
	 *
	 * @return bool
	 */
	function anahata_mikado_is_plugin_installed( $plugin ) {
		switch ( $plugin ) {
			case 'core':
				return defined( 'MIKADO_CORE_VERSION' );
				break;
			case 'woocommerce':
				return function_exists( 'is_woocommerce' );
				break;
			case 'visual-composer':
				return class_exists( 'WPBakeryVisualComposerAbstract' );
				break;
			case 'revolution-slider':
				return class_exists( 'RevSliderFront' );
				break;
			case 'contact-form-7':
				return defined( 'WPCF7_VERSION' );
				break;
			case 'wpml':
				return defined( 'ICL_SITEPRESS_VERSION' );
				break;
			case 'gutenberg-editor':
				return class_exists( 'WP_Block_Type' );
				break;
			case 'gutenberg-plugin':
				return function_exists( 'is_gutenberg_page' ) && is_gutenberg_page();
				break;
			default:
				return false;
				break;
		}
	}
}

if(!function_exists('anahata_mikado_get_first_main_color')) {
    /**
     * Returns first main color from options if set, else returns default first main color
     *
     * @return bool|string|void
     */
    function anahata_mikado_get_first_main_color() {
        return anahata_mikado_options()->getOptionValue('first_color') ? anahata_mikado_options()->getOptionValue('first_color') : '#5ed6c1';
    }
}

if(!function_exists('anahata_mikado_max_image_width_srcset')) {
    /**
     * Set max width for srcset to 1920
     *
     * @return int
     */
    function anahata_mikado_max_image_width_srcset() {
        return 1920;
    }

    add_filter('max_srcset_image_width', 'anahata_mikado_max_image_width_srcset');
}

if(!function_exists('anahata_mikado_is_ajax_request')) {
    /**
     * Function that checks if the incoming request is made by ajax function
     */
    function anahata_mikado_is_ajax_request() {

        return isset($_POST['ajaxReq']) && $_POST['ajaxReq'] == 'yes';

    }
}

if(!function_exists('anahata_mikado_generate_first_main_color_per_page')) {
    /**
     * Function that checks first main color in page options and generate css if color is set
     */
    function anahata_mikado_generate_first_main_color_per_page($style) {

        $id          = anahata_mikado_get_page_id();
        $first_color = anahata_mikado_get_meta_field_intersect('first_color', $id);

        if($first_color !== '') {

            extract(anahata_mikado_generate_first_color_selectors());

            $style[] = anahata_mikado_dynamic_css($color_selector, array('color' => $first_color));
            $style[] = anahata_mikado_dynamic_css($color_important_selector, array('color' => $first_color.' !important'));
            $style[] = anahata_mikado_dynamic_css('::selection', array('background' => $first_color));
            $style[] = anahata_mikado_dynamic_css('::-moz-selection', array('background' => $first_color));
            $style[] = anahata_mikado_dynamic_css($background_color_selector, array('background-color' => $first_color));
            $style[] = anahata_mikado_dynamic_css($background_color_important_selector, array('background-color' => $first_color.' !important'));
            $style[] = anahata_mikado_dynamic_css($border_color_selector, array('border-color' => $first_color));
            $style[] = anahata_mikado_dynamic_css($border_top_color_selector, array('border-top-color' => $first_color));
            $style[] = anahata_mikado_dynamic_css($border_bottom_color_selector, array('border-bottom-color' => $first_color));
            $style[] = anahata_mikado_dynamic_css($border_color_important_selector, array('border-color' => $first_color.' !important'));
        }

        return $style;
    }

    add_filter('anahata_mikado_add_page_custom_style', 'anahata_mikado_generate_first_main_color_per_page');
}

if(!function_exists('anahata_mikado_generate_first_color_selectors')) {
    /**
     * Function generate arrays of selectors for first color option
     */
    function anahata_mikado_generate_first_color_selectors() {

        $return_array = array();
        //generate color selector array
        $return_array['color_selector'] = array(
            'a',
            'h1 a:hover',
            'h2 a:hover',
            'h3 a:hover',
            'h4 a:hover',
            'h5 a:hover',
            'h6 a:hover',
            'p a',
            '.mkd-comment-holder .mkd-comment-reply-holder a.comment-reply-link:before',
            '.mkd-pagination li.active span',
            '#mkd-back-to-top',
            '.mkd-portfolio-single-holder .mkd-portfolio-single-likes .mkd-like.liked',
            '.widget.timetable_sidebar_box.widget_categories ul li a:hover',
            '.widget.timetable_sidebar_box.widget_search input[type=submit]',
            '.wpb_widgetised_column .widget.mkd-latest-posts-widget .mkd-image-in-box .mkd-item-date',
            'aside.mkd-sidebar .widget.mkd-latest-posts-widget .mkd-image-in-box .mkd-item-date',
            '.wpb_widgetised_column .widget .searchform input[type=submit]',
            'aside.mkd-sidebar .widget .searchform input[type=submit]',
            '.wpb_widgetised_column .widget.widget_categories ul li a:hover',
            '.wpb_widgetised_column .widget.widget_nav_menu .current-menu-item>a',
            '.wpb_widgetised_column .widget.widget_nav_menu ul.menu li a:hover',
            '.wpb_widgetised_column .widget.widget_recent_comments ul li a:hover',
            '.wpb_widgetised_column .widget.widget_rss ul li a:hover',
            'aside.mkd-sidebar .widget.widget_categories ul li a:hover',
            'aside.mkd-sidebar .widget.widget_nav_menu .current-menu-item>a',
            'aside.mkd-sidebar .widget.widget_nav_menu ul.menu li a:hover',
            'aside.mkd-sidebar .widget.widget_recent_comments ul li a:hover',
            'aside.mkd-sidebar .widget.widget_rss ul li a:hover',
            '.wpb_widgetised_column .widget.widget_meta ul li a:hover',
            '.wpb_widgetised_column .widget.widget_pages ul li a:hover',
            'aside.mkd-sidebar .widget.widget_meta ul li a:hover',
            'aside.mkd-sidebar .widget.widget_pages ul li a:hover',
            '.wpb_widgetised_column .widget.widget_archive ul li:hover',
            '.wpb_widgetised_column .widget.widget_archive ul li:hover a',
            '.wpb_widgetised_column .widget.widget_archive ul li:hover:before',
            'aside.mkd-sidebar .widget.widget_archive ul li:hover',
            'aside.mkd-sidebar .widget.widget_archive ul li:hover a',
            'aside.mkd-sidebar .widget.widget_archive ul li:hover:before',
            '.wpb_widgetised_column .widget.widget_mkd_twitter_widget .mkd-tweet-icon',
            'aside.mkd-sidebar .widget.widget_mkd_twitter_widget .mkd-tweet-icon',
            '.mkd-main-menu ul li.mkd-active-item a',
            '.mkd-main-menu ul li:hover a',
            '.mkd-main-menu ul .mkd-menu-featured-icon',
            '.mkd-main-menu>ul>li.mkd-active-item>a',
            '.mkd-main-menu>ul>li:hover>a',
            '.mkd-light-header.mkd-header-vertical .mkd-vertical-menu>ul>li:hover>a',
            '.mkd-dark-header .mkd-page-header>div:not(.mkd-sticky-header) .mkd-main-menu>ul>li:hover>a',
            '.mkd-dark-header.mkd-header-style-on-scroll .mkd-page-header .mkd-main-menu>ul>li:hover>a',
            '.mkd-dark-header.mkd-header-vertical .mkd-vertical-menu>ul>li:hover>a',
            '.mkd-drop-down .second .inner ul li a:hover',
            '.mkd-drop-down .wide .second .inner ul li.sub .flexslider ul li a:hover',
            '.mkd-drop-down .wide .second ul li .flexslider ul li a:hover',
            '.mkd-drop-down .wide .second .inner ul li.sub .flexslider.widget_flexslider .menu_recent_post_text a:hover',
            '.mkd-header-vertical .mkd-vertical-dropdown-float .second .inner ul li a:hover',
            '.mkd-header-vertical .mkd-vertical-menu>ul>li:hover a',
            '.mkd-header-vertical .mkd-vertical-menu .mkd-menu-featured-icon',
            '.mkd-mobile-header .mkd-mobile-nav a:hover',
            '.mkd-mobile-header .mkd-mobile-nav h4:hover',
            '.mkd-mobile-header .mkd-mobile-menu-opener a:hover',
            '.mkd-page-header .mkd-search-opener:hover',
            '.mkd-woocommerce-page .woocommerce-error a',
            '.mkd-woocommerce-page .woocommerce-info a',
            '.mkd-woocommerce-page .woocommerce-message a',
            'footer .mkd-footer-top-holder .widget.widget_archive ul li a:hover',
            'footer .mkd-footer-top-holder .widget.widget_archive ul li:hover',
            'footer .mkd-footer-top-holder .widget.widget_archive ul li:hover a',
            'footer .mkd-footer-top-holder .widget.widget_archive ul li:hover:before',
            'footer .mkd-footer-top-holder .widget.widget_pages ul li a:hover',
            'footer .mkd-footer-top-holder .widget ul li a:hover',
            'footer .mkd-footer-top-holder .widget.widget_categories ul li a:hover',
            'footer .mkd-footer-top-holder .widget.widget_product_tag_cloud .tagcloud a:hover',
            'footer .mkd-footer-top-holder .widget.widget_tag_cloud .tagcloud a:hover',
            'footer .mkd-footer-top-holder .widget.widget_mkd_twitter_widget .mkd-tweet-icon',
            'footer .mkd-footer-bottom-holder .widget.widget_nav_menu ul li a:hover',
            '.mkd-side-menu-button-opener.opened',
            '.mkd-side-menu-button-opener:hover',
            '.mkd-side-menu .widget .searchform input[type=submit]',
            '.mkd-side-menu .mkd-working-hours-holder .mkd-wh-item:last-child .mkd-wh-hours .mkd-wh-from',
            '.mkd-side-menu-slide-from-right .mkd-side-menu .mkd-blog-list-holder.mkd-image-in-box .mkd-item-date span',
            '.mkd-search-cover .mkd-search-close a:hover',
            '.mkd-portfolio-single-holder .mkd-portfolio-info-item h6',
            '.mkd-portfolio-single-holder .mkd-portfolio-single-nav .mkd-portfolio-single-prev .mkd-single-nav-arrow',
            '.mkd-portfolio-single-holder .mkd-portfolio-single-nav .mkd-portfolio-single-next .mkd-single-nav-arrow',
            '.mkd-counter-holder .mkd-counter-icon',
            '.mkd-icon-shortcode',
            '.mkd-icon-shortcode .mkd-icon-linea-icon',
            '.mkd-countdown-one .countdown-amount',
            '.mkd-message .mkd-message-inner a.mkd-close i:hover',
            '.mkd-ordered-list ol>li:before',
            '.mkd-icon-list-item .mkd-icon-list-icon-holder',
            '.mkd-icon-list-item .mkd-icon-list-icon-holder-inner .font_elegant',
            '.mkd-icon-list-item .mkd-icon-list-icon-holder-inner i',
            '.mkd-blog-slider-holder .mkd-post-content .mkd-author-desc .mkd-author-name',
            '.mkd-blog-slider-holder.mkd-blog-slider-two .mkd-post-info-comments:hover',
            '.mkd-working-hours-holder .mkd-wh-item:last-child',
            '.mkd-testimonials .mkd-testimonials-job',
            '.mkd-price-table .mkd-price-table-inner .mkd-pt-label-holder .mkd-pt-label-inner',
            '.mkd-accordion-holder .mkd-title-holder span.mkd-accordion-number',
            '.mkd-accordion-holder .mkd-title-holder.ui-state-active',
            '.mkd-accordion-holder .mkd-title-holder.ui-state-active .mkd-accordion-mark-icon',
            '.mkd-blog-list-holder.mkd-grid-type-2 .mkd-post-item-author-holder a:hover',
            '.mkd-blog-list-holder.mkd-masonry .mkd-post-item-author-holder a:hover',
            '.mkd-blog-list-holder.mkd-image-in-box h6.mkd-item-title a:hover',
            '.mkd-blog-list-holder.mkd-image-in-box .mkd-item-date',
            '.mkd-btn-outline.tribe-events-button',
            '.mkd-btn-outline.tribe-events-read-more',
            '.mkd-btn.mkd-btn-outline',
            '.post-password-form input.mkd-btn-outline[type=submit]',
            '.woocommerce .mkd-btn-outline.button',
            'input.mkd-btn-outline.wpcf7-form-control.wpcf7-submit',
            'blockquote .mkd-icon-quotations-holder',
            '.mkd-dropcaps',
            '.mkd-portfolio-filter-holder .mkd-portfolio-filter-holder-inner ul li.active',
            '.mkd-portfolio-filter-holder .mkd-portfolio-filter-holder-inner ul li.current',
            '.mkd-portfolio-filter-holder .mkd-portfolio-filter-holder-inner ul li:hover',
            '.mkd-portfolio-list-holder-outer .mkd-ptf-list-paging .woocommerce a.button:hover:after',
            '.mkd-portfolio-list-holder-outer .mkd-ptf-list-paging a.mkd-btn:hover:after',
            '.mkd-portfolio-list-holder-outer .mkd-ptf-list-paging a.tribe-events-button:hover:after',
            '.mkd-portfolio-list-holder-outer .mkd-ptf-list-paging a.tribe-events-read-more:hover:after',
            '.woocommerce .mkd-portfolio-list-holder-outer .mkd-ptf-list-paging a.button:hover:after',
            '.mkd-social-share-holder.mkd-list [class*=facebook]',
            '.mkd-social-share-holder.mkd-list [class*=googleplus]',
            '.mkd-social-share-holder.mkd-list [class*=twitter]',
            '.mkd-social-share-holder.mkd-list [class*=vimeo]',
            '.mkd-social-share-holder.mkd-list [class*=instagram]',
            '.mkd-social-share-holder.mkd-list [class*=pinterest]',
            '.mkd-social-share-holder.mkd-list [class*=tumblr]',
            '.mkd-social-share-holder.mkd-list [class*=linkedin]',
            '.mkd-process-holder .mkd-number-holder-inner',
            '.mkd-icon-progress-bar .mkd-ipb-active',
            '.mkd-tab-slider-holder .mkd-tab-slider-nav .mkd-tab-slider-nav-item.flex-active',
            '.mkd-tab-slider-holder .mkd-tab-slider-nav .mkd-tab-slider-nav-item.flex-active h6.mkd-tab-slider-nav-title',
            '.mkd-tab-slider-holder .mkd-tab-slider-nav .mkd-tab-slider-nav-item:hover',
            '.mkd-tab-slider-holder .mkd-tab-slider-nav .mkd-tab-slider-nav-item:hover h6.mkd-tab-slider-nav-title',
            '.mkd-fullscreen-menu-opener:hover',
            'nav.mkd-fullscreen-menu ul li a:hover',
            '.mkd-blog-holder article.sticky .mkd-post-title a',
            '.mkd-blog-holder article .mkd-post-info a:hover',
            '.mkd-blog-holder article .mkd-post-info .mkd-blog-date-icon',
            '.mkd-blog-holder article .mkd-post-info .mkd-post-info-author-icon',
            '.mkd-blog-holder article .mkd-post-info .mkd-post-info-comments-icon',
            '.mkd-blog-holder article .mkd-post-info .mkd-like i',
            '.mkd-blog-holder article .mkd-post-info .mkd-like.liked i',
            '.single .mkd-author-description .mkd-author-social-holder .mkd-author-social-icon',
            '.single .mkd-author-description .mkd-author-description-text-holder h6.mkd-author-position',
            '.single .mkd-single-tags-holder .mkd-tags a',
            '.single .mkd-single-tags-holder .mkd-tags a:hover',
            '.single .mkd-blog-single-navigation .mkd-blog-single-next .mkd-single-nav-arrow',
            '.single .mkd-blog-single-navigation .mkd-blog-single-prev .mkd-single-nav-arrow',
            '.mkd-post-content .mkd-post-info-category.mkd-post-info-item a:hover',
            'article .mkd-category span.icon_tags',
            '.mkd-page-header #lang_sel ul ul a:hover',
            '.mkd-top-bar #lang_sel ul ul a:hover',
            '#tribe-events-content-wrapper .tribe-bar-views-list li a:hover',
            '#tribe-events-content-wrapper .tribe-bar-views-list li.tribe-bar-active a',
            '#tribe-events-content-wrapper .tribe-events-sub-nav .tribe-events-nav-next a:hover',
            '#tribe-events-content-wrapper .tribe-events-sub-nav .tribe-events-nav-previous a:hover',
            '#tribe-events-content-wrapper .tribe-events-calendar td div[id*=tribe-events-daynum-] a:hover',
            '#tribe-events-content-wrapper .tribe-events-list .mkd-events-list-item-meta .mkd-events-single-meta-icon',
            '.mkd-tribe-events-single .mkd-events-single-main-content .tribe-events-cal-links a.tribe-events-gcal.tribe-events-button',
            '.mkd-tribe-events-single .mkd-events-single-main-content .tribe-events-cal-links a.tribe-events-ical.tribe-events-button:hover',
            '.mkd-tribe-events-single .mkd-events-single-meta .mkd-events-single-meta-item span.mkd-events-single-meta-icon',
            '.mkd-tribe-events-single .mkd-events-single-meta .mkd-events-single-next-event a:hover',
            '.mkd-tribe-events-single .mkd-events-single-meta .mkd-events-single-prev-event a:hover',
            '.mkd-ttevents-single .mkd-event-single-icon',
            '.mkd-ttevents-single .tt_event_items_list li.type_info .tt_event_text',
            '.mkd-ttevents-single .tt_event_items_list li:not(.type_info):before',
            '.woocommerce-pagination .page-numbers li span.current',
            '.mkd-woocommerce-page .woocommerce-error',
            '.mkd-woocommerce-page .woocommerce-info',
            '.mkd-woocommerce-page .woocommerce-message',
            '.mkd-woocommerce-page .select2-results .select2-highlighted',
            '.mkd-woocommerce-page .price',
            '.woocommerce .price',
            '.mkd-woocommerce-page .price ins .amount',
            '.woocommerce .price ins .amount',
            '.mkd-woocommerce-page .star-rating:before',
            '.woocommerce .star-rating:before',
            '.mkd-woocommerce-page .star-rating span:before',
            '.woocommerce .star-rating span:before',
            '.single-product .mkd-single-product-summary .price .amount ins',
            '.single-product .mkd-single-product-summary form.cart .price ins .amount',
            '.mkd-woocommerce-with-sidebar aside.mkd-sidebar .widget .product-categories a:hover',
            '.mkd-woocommerce-with-sidebar aside.mkd-sidebar .widget.widget_layered_nav a:hover',
            '.mkd-woocommerce-with-sidebar aside.mkd-sidebar .widget.widget_product_categories .product-categories li a:hover',
            '.mkd-woocommerce-with-sidebar aside.mkd-sidebar .widget.widget_product_categories .product-categories li:hover .count',
            '.wpb_widgetised_column .widget .product-categories a:hover',
            '.wpb_widgetised_column .widget.widget_layered_nav a:hover',
            '.wpb_widgetised_column .widget.widget_product_categories .product-categories li a:hover',
            '.wpb_widgetised_column .widget.widget_product_categories .product-categories li:hover .count',
            '.mkd-woocommerce-with-sidebar aside.mkd-sidebar .widget .product_list_widget li .mkd-woo-product-widget-content .amount',
            '.mkd-woocommerce-with-sidebar aside.mkd-sidebar .widget .product_list_widget li .mkd-woo-product-widget-content ins',
            '.wpb_widgetised_column .widget .product_list_widget li .mkd-woo-product-widget-content .amount',
            '.wpb_widgetised_column .widget .product_list_widget li .mkd-woo-product-widget-content ins',
            '.mkd-woocommerce-with-sidebar aside.mkd-sidebar .widget.widget_shopping_cart .cart_list a',
            '.wpb_widgetised_column .widget.widget_shopping_cart .cart_list a',
            '.mkd-shopping-cart-dropdown .mkd-item-info-holder .mkd-item-left a:hover',
            '.mkd-shopping-cart-dropdown ul li a:hover',
            '.mkd-shopping-cart-dropdown .mkd-item-info-holder .mkd-item-right .remove:hover',
            '.mkd-shopping-cart-dropdown span.mkd-total span',
            '.woocommerce-cart .woocommerce form:not(.woocommerce-shipping-calculator) .product-name a:hover',
            '.woocommerce-cart .woocommerce .cart-collaterals .mkd-shipping-calculator .woocommerce-shipping-calculator>p a:hover'
        );

        //generate color important selector array
        $return_array['color_important_selector'] = array(
            '.mkd-twitter-slider.mkd-nav-dark .slick-slider .slick-dots li.slick-active button:before',
            '.mkd-process-slider-holder .slick-slider .slick-dots li.slick-active button:before',
            '.mkd-team-slider-holder.mkd-nav-light .slick-slider .slick-dots li.slick-active button:before',
            '.mkd-team-slider-holder .slick-dots li.slick-active button:before',
            'table.tt_timetable .event a.event_header:hover',
            'table.tt_timetable .event a:hover',
            '.woocommerce-pagination .page-numbers li a:hover',
            '.woocommerce-pagination .page-numbers li span.current:hover',
            '.woocommerce-pagination .page-numbers li span:hover',
            '.mkd-light-header .mkd-page-header>div:not(.mkd-sticky-header) .mkd-menu-area .mkd-main-menu-widget-area .mkd-btn.checkout:hover span.mkd-btn-text'
        );

        //generate background color selectors array
        $return_array['background_color_selector'] = array(
            '.mkd-st-loader .pulse',
            '.mkd-st-loader .double_pulse .double-bounce1',
            '.mkd-st-loader .double_pulse .double-bounce2',
            '.mkd-st-loader .cube',
            '.mkd-st-loader .rotating_cubes .cube1',
            '.mkd-st-loader .rotating_cubes .cube2',
            '.mkd-st-loader .stripes>div',
            '.mkd-st-loader .wave>div',
            '.mkd-st-loader .two_rotating_circles .dot1',
            '.mkd-st-loader .two_rotating_circles .dot2',
            '.mkd-st-loader .five_rotating_circles .container1>div',
            '.mkd-st-loader .five_rotating_circles .container2>div',
            '.mkd-st-loader .five_rotating_circles .container3>div',
            '.mkd-st-loader .lines .line1',
            '.mkd-st-loader .lines .line2',
            '.mkd-st-loader .lines .line3',
            '.mkd-st-loader .lines .line4',
            '#mkd-back-to-top',
            '.wpb_widgetised_column .widget.widget_product_tag_cloud .tagcloud a:hover',
            '.wpb_widgetised_column .widget.widget_tag_cloud .tagcloud a:hover',
            'aside.mkd-sidebar .widget.widget_product_tag_cloud .tagcloud a:hover',
            'aside.mkd-sidebar .widget.widget_tag_cloud .tagcloud a:hover',
            '.mkd-main-menu>ul>li>a span.menu_line',
            '.mkd-team .mkd-team-hover',
            '.mkd-team.main-info-below-image .mkd-team-info .mkd-team-position',
            '.mkd-icon-shortcode.circle',
            '.mkd-icon-shortcode.square',
            '.mkd-product-slider ul.products .product .added_to_cart',
            '.mkd-progress-bar .mkd-progress-content-outer .mkd-progress-content',
            '.mkd-blog-slider-holder .slick-dots li.slick-active',
            '.mkd-working-hours-holder.mkd-working-hours-light',
            '.mkd-price-table.mkd-pt-active .mkd-price-table-inner',
            '.mkd-events-list-item-date-holder',
            '.mkd-pie-chart-doughnut-holder .mkd-pie-legend ul li .mkd-pie-color-holder',
            '.mkd-product-slider .products>li.product .mkd-btn',
            '.mkd-product-slider .products>li.product .post-password-form input[type=submit]',
            '.mkd-product-slider .products>li.product .tribe-events-button',
            '.mkd-product-slider .products>li.product .tribe-events-read-more',
            '.mkd-product-slider .products>li.product .woocommerce .button',
            '.mkd-product-slider .products>li.product input.wpcf7-form-control.wpcf7-submit',
            '.post-password-form .mkd-product-slider .products>li.product input[type=submit]',
            '.woocommerce .mkd-product-slider .products>li.product .button',
            '.mkd-product-slider .mkd-product-slider-pager a.selected',
            '.mkd-pie-chart-pie-holder .mkd-pie-legend ul li .mkd-pie-color-holder',
            '.mkd-tabs .mkd-tab-line-inner:after',
            '.mkd-tabs.mkd-horizontal .mkd-tabs-nav li.ui-tabs-active:not(.mkd-tab-line) a:after',
            '.mkd-btn.mkd-btn-solid',
            '.post-password-form input[type=submit]',
            '.tribe-events-button',
            '.tribe-events-read-more',
            '.woocommerce .button',
            'input.wpcf7-form-control.wpcf7-submit',
            '.mkd-dropcaps.mkd-circle',
            '.mkd-dropcaps.mkd-square',
            '.mkd-process-slider-holder .mkd-pi-flip .mkd-pi-back',
            '.mkd-comparision-pricing-tables-holder .mkd-cpt-table .mkd-cpt-table-btn a',
            '.mkd-vertical-progress-bar-holder .mkd-vpb-active-bar',
            '.mkd-team-slider-holder .mkd-team.main-info-below-image.mkd-team-flip .mkd-team-back',
            '.mkd-zooming-slider-holder .slick-dots .slick-active button',
            '.mkd-zooming-slider-holder .slick-dots li:hover button',
            '#multiscroll-nav ul li .active span',
            '.mkd-card-slider-holder .controls .dots .dots-inner .dot.active',
            '.widget_mkd_call_to_action_button .mkd-call-to-action-button',
            '.mejs-container .mkd-blog-audio-holder',
            '.mejs-container .mejs-controls',
            'body div.pp_default a.pp_next:before',
            'body div.pp_default a.pp_previous:before',
            '#tribe-events-content-wrapper .tribe-events-calendar td.tribe-events-present div[id*=tribe-events-daynum-]',
            '.mkd-tribe-events-single .mkd-events-single-main-info .mkd-events-single-date-holder',
            '.mkd-tribe-events-single .mkd-events-single-main-content .tribe-events-cal-links a.tribe-events-gcal.tribe-events-button:hover',
            '#tribe-events-content-wrapper .tribe-events-calendar .tribe-events-has-events:after',
            '.tt_tabs .tt_tabs_navigation li a',
            '.widget.upcoming_events_widget .tt_upcoming_event_controls a:hover',
            '.mkd-woocommerce-page .woocommerce-message a',
            '.mkd-woocommerce-page ul.products li:hover .added_to_cart',
            '.woocommerce ul.products li:hover .added_to_cart',
            '.mkd-woocommerce-page .mkd-onsale',
            '.mkd-woocommerce-page .mkd-out-of-stock',
            '.woocommerce .mkd-onsale',
            '.woocommerce .mkd-out-of-stock',
            '.mkd-woocommerce-page .mkd-out-of-stock',
            '.woocommerce .mkd-out-of-stock',
            '.mkd-woocommerce-with-sidebar aside.mkd-sidebar .widget.widget_price_filter .ui-slider .ui-slider-handle',
            '.wpb_widgetised_column .widget.widget_price_filter .ui-slider .ui-slider-handle',
            '.mkd-woocommerce-with-sidebar aside.mkd-sidebar .widget.widget_price_filter .ui-slider-horizontal .ui-slider-range',
            '.wpb_widgetised_column .widget.widget_price_filter .ui-slider-horizontal .ui-slider-range',
            '.mkd-shopping-cart-outer .mkd-shopping-cart-header .mkd-header-cart .mkd-cart-count'
        );

        $return_array['background_color_important_selector'] = array(
            '.mkd-center-button input.wpcf7-form-control.wpcf7-submit:not(.mkd-btn-custom-hover-bg).mkd-contact2:hover',
            '.mkd-woocommerce-page .price_slider_amount button.button',
            '.woocommerce .price_slider_amount button.button'
        );

        //generate border color selectors array
        $return_array['border_color_selector'] = array(
            '.mkd-st-loader .pulse_circles .ball',
            '.wpb_widgetised_column .widget.widget_product_tag_cloud .tagcloud a:hover',
            '.wpb_widgetised_column .widget.widget_tag_cloud .tagcloud a:hover',
            'aside.mkd-sidebar .widget.widget_product_tag_cloud .tagcloud a:hover',
            'aside.mkd-sidebar .widget.widget_tag_cloud .tagcloud a:hover',
            '.mkd-btn.mkd-btn-solid',
            '.post-password-form input[type=submit]',
            '.tribe-events-button',
            '.tribe-events-read-more',
            '.woocommerce .button',
            'input.wpcf7-form-control.wpcf7-submit',
            '.mkd-btn-outline.tribe-events-button',
            '.mkd-btn-outline.tribe-events-read-more',
            '.mkd-btn.mkd-btn-outline',
            '.post-password-form input.mkd-btn-outline[type=submit]',
            '.woocommerce .mkd-btn-outline.button',
            'input.mkd-btn-outline.wpcf7-form-control.wpcf7-submit',
            '.mkd-tribe-events-single .mkd-events-single-main-content .tribe-events-cal-links a.tribe-events-gcal.tribe-events-button',
            '.mkd-tribe-events-single .mkd-events-single-main-content .tribe-events-cal-links a.tribe-events-gcal.tribe-events-button:hover',
            '.mkd-tribe-events-single .mkd-events-single-main-content .tribe-events-cal-links a.tribe-events-ical.tribe-events-button:hover',
            'table.tt_timetable .tt_tooltip .tt_tooltip_arrow',
            '.widget.upcoming_events_widget .tt_upcoming_event_controls a:hover',
            '.mkd-woocommerce-page .woocommerce-error',
            '.mkd-woocommerce-page .woocommerce-info',
            '.mkd-woocommerce-page .woocommerce-message',
            '.mkd-woocommerce-page .woocommerce-message a',
            '.mkd-woocommerce-page .price_slider_amount button.button',
            '.woocommerce .price_slider_amount button.button',
            '.woocommerce-cart .woocommerce form:not(.woocommerce-shipping-calculator) .actions .coupon input[type=text]:focus'
        );

        $return_array['border_color_important_selector'] = array(
            '.mkd-center-button input.wpcf7-form-control.wpcf7-submit:not(.mkd-btn-custom-hover-bg).mkd-contact2:hover',
            '.mkd-product-slider .products>li.product .mkd-btn',
            '.mkd-product-slider .products>li.product .post-password-form input[type=submit]',
            '.mkd-product-slider .products>li.product .tribe-events-button',
            '.mkd-product-slider .products>li.product .tribe-events-read-more',
            '.mkd-product-slider .products>li.product .woocommerce .button',
            '.mkd-product-slider .products>li.product input.wpcf7-form-control.wpcf7-submit',
            '.post-password-form .mkd-product-slider .products>li.product input[type=submit]',
            '.woocommerce .mkd-product-slider .products>li.product .button',
            '.tt_tabs .tt_tabs_navigation li a',
            '.input.wpcf7-form-control.wpcf7-submit',
            '.mkd-light-header .mkd-page-header>div:not(.mkd-sticky-header) .mkd-menu-area .mkd-main-menu-widget-area a.checkout:hover',
            '.mkd-light-header .mkd-page-header>div:not(.mkd-sticky-header) .mkd-menu-area .mkd-main-menu-widget-area a.view-cart:hover'
        );

        $return_array['border_top_color_selector'] = array(
            '.mkd-progress-bar .mkd-progress-number-wrapper.mkd-floating .mkd-down-arrow'
        );

        $return_array['border_bottom_color_selector'] = array(
            'blockquote .mkd-icon-quotations-holder:after,blockquote .mkd-icon-quotations-holder:before',
            '.woocommerce-cart .woocommerce .cart-collaterals .mkd-shipping-calculator .woocommerce-shipping-calculator>p:after',
            '.woocommerce-account .woocommerce h2:after'
        );

        return $return_array;

    }

}

if(!function_exists('anahata_mikado_attachment_image_additional_fields')) {
    /**
     * Add Attachment Image Sizes option
     *
     * @param $form_fields array, fields to include in attachment form
     * @param $post object, attachment record in database
     *
     * @return mixed
     */
    function anahata_mikado_attachment_image_additional_fields($form_fields, $post) {

        // ADDING IMAGE SIZE FILED - START //

        $options_image_size = array(
            'default'            => esc_html__('Default', 'anahata'),
            'large_height'       => esc_html__('Large Height', 'anahata'),
            'large_width_height' => esc_html__('Large Width/Height', 'anahata')
        );

        $html_image_size     = '';
        $selected_image_size = get_post_meta($post->ID, 'attachment_image_size', true);

        $html_image_size .= '<select name="attachments['.$post->ID.'][attachment-image-size]" class="attachment-image-size" data-setting="attachment-image-size">';
        // Browse and add the options
        foreach($options_image_size as $key => $value) {
            if($key == $selected_image_size) {
                $html_image_size .= '<option value="'.$key.'" selected>'.$value.'</option>';
            } else {
                $html_image_size .= '<option value="'.$key.'">'.$value.'</option>';
            }
        }

        $html_image_size .= '</select>';

        $form_fields['attachment-image-size'] = array(
            'label'       => 'Image Size',
            'input'       => 'html',
            'html'        => $html_image_size,
            'application' => 'image',
            'exclusions'  => array('audio', 'video'),
            'value'       => get_post_meta($post->ID, 'attachment_image_size', true)
        );

        // ADDING IMAGE SIZE FILED - END //

        // ADDING IMAGE LINK FILED - START //

        $form_fields['attachment-image-link'] = array(
            'label'       => 'Image Link',
            'input'       => 'text',
            'application' => 'image',
            'exclusions'  => array('audio', 'video'),
            'value'       => get_post_meta($post->ID, 'attachment_image_link', true)
        );

        // ADDING IMAGE LINK FILED - END //

        // ADDING IMAGE TARGET FILED - START //

        $options_image_target = array(
            '_selft' => esc_html__('Same Window', 'anahata'),
            '_blank' => esc_html__('New Window', 'anahata'),
        );

        $html_image_target     = '';
        $selected_image_target = get_post_meta($post->ID, 'attachment_image_target', true);

        $html_image_target .= '<select name="attachments['.$post->ID.'][attachment-image-target]" class="attachment-image-target" data-setting="attachment-image-target">';
        // Browse and add the options
        foreach($options_image_target as $key => $value) {
            if($key == $selected_image_target) {
                $html_image_target .= '<option value="'.$key.'" selected>'.$value.'</option>';
            } else {
                $html_image_target .= '<option value="'.$key.'">'.$value.'</option>';
            }
        }

        $html_image_target .= '</select>';

        $form_fields['attachment-image-target'] = array(
            'label'       => 'Image Target',
            'input'       => 'html',
            'html'        => $html_image_target,
            'application' => 'image',
            'exclusions'  => array('audio', 'video'),
            'value'       => get_post_meta($post->ID, 'attachment_image_target', true)
        );

        // ADDING IMAGE TARGET FILED - END //

        return $form_fields;
    }

    add_filter('attachment_fields_to_edit', 'anahata_mikado_attachment_image_additional_fields', 10, 2);

}

if(!function_exists('anahata_mikado_attachment_image_additional_fields_save')) {
    /**
     * Save values of Attachment Image sizes in media uploader
     *
     * @param $post array, the post data for database
     * @param $attachment array, attachment fields from $_POST form
     *
     * @return mixed
     */
    function anahata_mikado_attachment_image_additional_fields_save($post, $attachment) {

        if(isset($attachment['attachment-image-size'])) {
            update_post_meta($post['ID'], 'attachment_image_size', $attachment['attachment-image-size']);
        }

        if(isset($attachment['attachment-image-link'])) {
            update_post_meta($post['ID'], 'attachment_image_link', $attachment['attachment-image-link']);
        }

        if(isset($attachment['attachment-image-target'])) {
            update_post_meta($post['ID'], 'attachment_image_target', $attachment['attachment-image-target']);
        }

        return $post;
    }

    add_filter('attachment_fields_to_save', 'anahata_mikado_attachment_image_additional_fields_save', 10, 2);
}

if ( ! function_exists( 'anahata_mikado_get_module_part' ) ) {
	function anahata_mikado_get_module_part( $module ) {
		return $module;
	}
}

if ( ! function_exists( 'anahata_mikado_is_gutenberg_installed' ) ) {
	/**
	 * Function that checks if Gutenberg plugin installed
	 * @return bool
	 */
	function anahata_mikado_is_gutenberg_installed() {
		return function_exists( 'is_gutenberg_page' ) && is_gutenberg_page();
	}
}

if ( ! function_exists( 'anahata_mikado_is_wp_gutenberg_installed' ) ) {
	/**
	 * Function that checks if WordPress 5.x with Gutenberg editor installed
	 * @return bool
	 */
	function anahata_mikado_is_wp_gutenberg_installed() {
		return class_exists( 'WP_Block_Type' );
	}
}
