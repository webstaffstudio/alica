<?php
if(!function_exists('anahata_mikado_contact_form_map')) {
	/**
	 * Map Contact Form 7 shortcode
	 * Hooks on vc_after_init action
	 */
	function anahata_mikado_contact_form_map() {

		vc_add_param('contact-form-7', array(
			'type'        => 'dropdown',
			'heading' => esc_html__( 'Style', 'anahata' ),
			'param_name'  => 'html_class',
			'value'       => array(
				'Default'        => 'default',
				'Custom Style 1' => 'cf7_custom_style_1',
				'Custom Style 2' => 'cf7_custom_style_2',
				'Custom Style 3' => 'cf7_custom_style_3'
			),
			'description' => esc_html__('You can style each form element individually in Mikado Options > Contact Form 7', 'anahata')
		));

	}

	add_action('vc_after_init', 'anahata_mikado_contact_form_map');
}
?>