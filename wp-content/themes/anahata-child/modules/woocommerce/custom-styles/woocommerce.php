<?php

if(!function_exists('anahata_mikado_woo_single_style')) {

	function anahata_mikado_woo_single_style() {

		$styles = array();

		if(anahata_mikado_options()->getOptionValue('hide_product_info') === 'yes') {
			$styles['display'] = 'none';
		}

		$selector = array(
			'.single.single-product .product_meta'
		);

		echo anahata_mikado_dynamic_css($selector, $styles);

	}

	add_action('anahata_mikado_style_dynamic', 'anahata_mikado_woo_single_style');

}

?>