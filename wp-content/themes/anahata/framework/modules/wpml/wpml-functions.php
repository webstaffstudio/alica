<?php

if(!function_exists('anahata_mikado_get_wpml_pages_for_current_page')) {
	/**
	 * Function that returns urls translated pages for current page.
	 * @return array array of url urls translated pages for current page.
	 *
	 * @version 0.1
	 */
	function anahata_mikado_get_wpml_pages_for_current_page() {
		$wpml_pages_for_current_page = array();

		if(anahata_mikado_is_wpml_installed()) {
			$language_pages = icl_get_languages('skip_missing=0');

			foreach($language_pages as $key => $language_page) {
				$wpml_pages_for_current_page[] = $language_page['url'];
			}
		}

		return $wpml_pages_for_current_page;
	}
}

if(!function_exists('anahata_mikado_disable_wpml_css')) {
	function anahata_mikado_disable_wpml_css() {
		define('ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true);
	}

	add_action('after_setup_theme', 'anahata_mikado_disable_wpml_css');
}