<?php

if(!function_exists('anahata_mikado_get_button_html')) {
	/**
	 * Calls button shortcode with given parameters and returns it's output
	 *
	 * @param $params
	 *
	 * @return mixed|string
	 */
	function anahata_mikado_get_button_html($params) {
        if(anahata_mikado_core_installed()) {
            $button_html = anahata_mikado_execute_shortcode('mkd_button', $params);
            $button_html = str_replace("\n", '', $button_html);

            return $button_html;
        }
	}
}

if(!function_exists('mkd_get_btn_types')) {
	function anahata_mikado_get_btn_types($empty_val = false) {
		$types = array(
			'outline'       => 'Outline',
			'solid'         => 'Solid',
			'white'         => 'White',
			'transparent'	=> 'Transparent',
			'white-outline' => 'White Outline',
			'black'         => 'Black'
		);

		if($empty_val) {
			$types = array_merge(array(
				'' => 'Default'
			), $types);
		}

		return $types;
	}
}