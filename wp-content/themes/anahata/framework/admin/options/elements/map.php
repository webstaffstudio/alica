<?php

if(!function_exists('anahata_mikado_load_elements_map')) {
	/**
	 * Add Elements option page for shortcodes
	 */
	function anahata_mikado_load_elements_map() {

		anahata_mikado_add_admin_page(
			array(
				'slug'  => '_elements_page',
				'title' => esc_html__('Elements', 'anahata'),
				'icon'  => 'icon_star_alt '
			)
		);

		do_action('anahata_mikado_options_elements_map');

	}

	add_action('anahata_mikado_options_map', 'anahata_mikado_load_elements_map');

}