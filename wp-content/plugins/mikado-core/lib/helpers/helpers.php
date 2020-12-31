<?php

if(!function_exists('mkd_core_version_class')) {
	/**
	 * Adds plugins version class to body
	 *
	 * @param $classes
	 *
	 * @return array
	 */
	function mkd_core_version_class($classes) {
		$classes[] = 'mkd-core-'.MIKADO_CORE_VERSION;

		return $classes;
	}

	add_filter('body_class', 'mkd_core_version_class');
}

if(!function_exists('mkd_core_theme_installed')) {
	/**
	 * Checks whether theme is installed or not
	 * @return bool
	 */
	function mkd_core_theme_installed() {
		return defined('MIKADO_ROOT');
	}
}

if(!function_exists('mkd_core_get_carousel_slider_array')) {
	/**
	 * Function that returns associative array of carousels,
	 * where key is term slug and value is term name
	 * @return array
	 */
	function mkd_core_get_carousel_slider_array() {
		$carousels_array = array();
        $args = array(
            'taxonomy' => 'carousels_category'
        );
        $terms = get_terms($args);

		if(is_array($terms) && count($terms)) {
			$carousels_array[''] = '';
			foreach($terms as $term) {
				$carousels_array[$term->slug] = $term->name;
			}
		}

		return $carousels_array;
	}
}

if(!function_exists('mkd_core_get_carousel_slider_array_vc')) {
	/**
	 * Function that returns array of carousels formatted for Visual Composer
	 *
	 * @return array array of carousels where key is term title and value is term slug
	 *
	 * @see mkd_core_get_carousel_slider_array
	 */
	function mkd_core_get_carousel_slider_array_vc() {
		return array_flip(mkd_core_get_carousel_slider_array());
	}
}

if(!function_exists('mkd_core_get_shortcode_module_template_part')) {
	/**
	 * Loads module template part.
	 *
	 * @param string $shortcode name of the shortcode folder
	 * @param string $template name of the template to load
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 *
	 * @see anahata_mikado_get_template_part()
	 */
	function mkd_core_get_shortcode_module_template_part($template, $module, $slug = '', $params = array()) {

		//HTML Content from template
		$html          = '';
		$template_path = MIKADO_CORE_CPT_PATH.'/'.$module.'/shortcodes';

		$temp = $template_path.'/'.$template;
		if(is_array($params) && count($params)) {
			extract($params);
		}

		$template = '';

		if($temp !== '') {
			if($slug !== '') {
				$template = "{$temp}-{$slug}.php";
			}
			$template = $temp.'.php';
		}
		if($template) {
			ob_start();
			include($template);
			$html = ob_get_clean();
		}

		return $html;
	}
}

if(!function_exists('mkd_core_ajax_url')) {
	/**
	 * load themes ajax functionality
	 *
	 */
	function mkd_core_ajax_url() {
		echo '<script type="application/javascript">var mkdCoreAjaxUrl = "'.admin_url('admin-ajax.php').'"</script>';
	}

	add_action('wp_enqueue_scripts', 'mkd_core_ajax_url');

}

if(!function_exists('mkd_core_inline_style')) {
	/**
	 * Function that echoes generated style attribute
	 *
	 * @param $value string | array attribute value
	 *
	 */
	function mkd_core_inline_style($value) {
		echo mkd_core_get_inline_style($value);
	}
}

if(!function_exists('mkd_core_get_inline_style')) {
	/**
	 * Function that generates style attribute and returns generated string
	 *
	 * @param $value string | array value of style attribute
	 *
	 * @return string generated style attribute
	 *
	 */
	function mkd_core_get_inline_style($value) {
		return mkd_core_get_inline_attr($value, 'style', ';');
	}
}

if(!function_exists('mkd_core_class_attribute')) {
	/**
	 * Function that echoes class attribute
	 *
	 * @param $value string value of class attribute
	 *
	 * @see mkd_core_get_class_attribute()
	 */
	function mkd_core_class_attribute($value) {
		echo mkd_core_get_class_attribute($value);
	}
}

if(!function_exists('mkd_core_get_class_attribute')) {
	/**
	 * Function that returns generated class attribute
	 *
	 * @param $value string value of class attribute
	 *
	 * @return string generated class attribute
	 *
	 * @see mkd_core_get_inline_attr()
	 */
	function mkd_core_get_class_attribute($value) {
		return mkd_core_get_inline_attr($value, 'class', ' ');
	}
}

if(!function_exists('mkd_core_get_inline_attr')) {
	/**
	 * Function that generates html attribute
	 *
	 * @param $value string | array value of html attribute
	 * @param $attr string name of html attribute to generate
	 * @param $glue string glue with which to implode $attr. Used only when $attr is array
	 *
	 * @return string generated html attribute
	 */
	function mkd_core_get_inline_attr($value, $attr, $glue = '') {
		if(!empty($value)) {

			if(is_array($value) && count($value)) {
				$properties = implode($glue, $value);
			} elseif($value !== '') {
				$properties = $value;
			}

			return $attr.'="'.esc_attr($properties).'"';
		}

		return '';
	}
}

if(!function_exists('mkd_core_inline_attr')) {
	/**
	 * Function that generates html attribute
	 *
	 * @param $value string | array value of html attribute
	 * @param $attr string name of html attribute to generate
	 * @param $glue string glue with which to implode $attr. Used only when $attr is array
	 *
	 * @return string generated html attribute
	 */
	function mkd_core_inline_attr($value, $attr, $glue = '') {
		echo mkd_core_get_inline_attr($value, $attr, $glue);
	}
}

if(!function_exists('mkd_core_get_inline_attrs')) {
	/**
	 * Generate multiple inline attributes
	 *
	 * @param $attrs
	 *
	 * @return string
	 */
	function mkd_core_get_inline_attrs($attrs) {
		$output = '';

		if(is_array($attrs) && count($attrs)) {
			foreach($attrs as $attr => $value) {
				$output .= ' '.mkd_core_get_inline_attr($value, $attr);
			}
		}

		ltrim($output);

		return $output;
	}
}

if(!function_exists('mkd_core_get_attachment_id_from_url')) {
	/**
	 * Function that retrieves attachment id for passed attachment url
	 *
	 * @param $attachment_url
	 *
	 * @return null|string
	 */
	function mkd_core_get_attachment_id_from_url($attachment_url) {
		global $wpdb;
		$attachment_id = '';

		//is attachment url set?
		if($attachment_url !== '') {
			//prepare query

			$query = $wpdb->prepare("SELECT ID FROM {$wpdb->posts} WHERE guid=%s", $attachment_url);

			//get attachment id
			$attachment_id = $wpdb->get_var($query);
		}

		//return id
		return $attachment_id;
	}
}

if (!function_exists('mkd_core_add_user_custom_fields')) {
    /**
     * Function creates custom social fields for users
     *
     * return $user_contact
     */
    function mkd_core_add_user_custom_fields($user_contact)
    {

        /**
         * Function that add custom user fields
         **/
        $user_contact['position'] = esc_html__('Position', 'mikado-core');
        $user_contact['instagram'] = esc_html__('Instagram', 'mikado-core');
        $user_contact['twitter'] = esc_html__('Twitter', 'mikado-core');
        $user_contact['pinterest'] = esc_html__('Pinterest', 'mikado-core');
        $user_contact['tumblr'] = esc_html__('Tumbrl', 'mikado-core');
        $user_contact['facebook'] = esc_html__('Facebook', 'mikado-core');
        $user_contact['google-plus'] = esc_html__('Google Plus', 'mikado-core');
        $user_contact['linkedin'] = esc_html__('Linkedin', 'mikado-core');

        return $user_contact;
    }

    add_filter('user_contactmethods', 'mkd_core_add_user_custom_fields');
}

if(!function_exists('mkd_core_init_shortcode_loader')) {
    function mkd_core_init_shortcode_loader() {

		include_once MIKADO_CORE_ABS_PATH.'/shortcodes/lib/shortcode-loader.php';
    }

    add_action('anahata_mikado_shortcode_loader', 'mkd_core_init_shortcode_loader');
}

if ( ! function_exists( 'mkd_core_is_revolution_slider_installed' ) ) {
    function mkd_core_is_revolution_slider_installed() {
        return class_exists( 'RevSliderFront' );
    }
}

if ( ! function_exists( 'mikado_core_get_core_shortcode_template_part' ) ) {
	/**
	 * Loads module template part.
	 *
	 * @param string $template name of the template to load
	 * @param string $shortcode name of the shortcode folder
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 *
	 * @return html
	 */
	function mikado_core_get_core_shortcode_template_part( $template, $shortcode, $slug = '', $params = array() ) {

		//HTML Content from template
		$html          = '';
		$template_path = MIKADO_CORE_SHORTCODES_PATH . '/' . $shortcode;

		$temp = $template_path . '/' . $template;

		if ( is_array( $params ) && count( $params ) ) {
			extract( $params );
		}

		$template = '';

		if ( ! empty( $temp ) ) {
			if ( ! empty( $slug ) ) {
				$template = "{$temp}-{$slug}.php";

				if ( ! file_exists( $template ) ) {
					$template = $temp . '.php';
				}
			} else {
				$template = $temp . '.php';
			}
		}

		if ( $template ) {
			ob_start();
			include( $template );
			$html = ob_get_clean();
		}

		return $html;
	}
}

/* Function for adding custom meta boxes hooked to default action */
if ( class_exists( 'WP_Block_Type' ) && defined( 'MIKADO_ROOT' ) ) {
	add_action( 'admin_head', 'anahata_mikado_meta_box_add' );
} else {
	add_action( 'add_meta_boxes', 'anahata_mikado_meta_box_add' );
}

if ( ! function_exists( 'anahata_mikado_create_meta_box_handler' ) ) {
	function anahata_mikado_create_meta_box_handler( $box, $key, $screen ) {
		add_meta_box(
			'mkd-meta-box-' . $key,
			$box->title,
			'anahata_mikado_render_meta_box',
			$screen,
			'advanced',
			'high',
			array( 'box' => $box )
		);
	}
}

if(!function_exists('anahata_mikado_vc_custom_style')) {

	/**
	 * Function that print custom page style
	 */

	function anahata_mikado_vc_custom_style() {
		if(anahata_mikado_visual_composer_installed()) {
			$id = anahata_mikado_get_page_id();
			if(is_page() || is_single() || is_singular('portfolio-item')) {

				$shortcodes_custom_css = get_post_meta($id, '_wpb_shortcodes_custom_css', true);
				if(!empty($shortcodes_custom_css)) {
					echo '<style type="text/css" data-type="vc_shortcodes-custom-css-'.esc_attr($id).'">';
					echo get_post_meta($id, '_wpb_shortcodes_custom_css', true);
					echo '</style>';
				}

				$post_custom_css = get_post_meta($id, '_wpb_post_custom_css', true);
				if(!empty($post_custom_css)) {
					echo '<style type="text/css" data-type="vc_custom-css-'.esc_attr($id).'">';
					echo get_post_meta($id, '_wpb_post_custom_css', true);
					echo '</style>';
				}
			}
		}
	}
}


if(!function_exists('anahata_mikado_register_vc_custom_style')) {

	/**
	 * Function that print custom page style
	 */

	function anahata_mikado_register_vc_custom_style() {
		if(anahata_mikado_is_ajax_enabled() && anahata_mikado_is_ajax_request()) {
			add_action('anahata_mikado_ajax_meta', 'anahata_mikado_vc_custom_style');
		}
	}

	add_action('anahata_mikado_after_options_map', 'anahata_mikado_register_vc_custom_style');
}