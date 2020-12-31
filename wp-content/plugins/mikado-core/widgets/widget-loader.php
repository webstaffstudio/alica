<?php

if(!function_exists('anahata_mikado_register_widgets')) {

	function anahata_mikado_register_widgets() {

		$widgets = array(
			'AnahataMikadoLatestPosts',
			'AnahataMikadoSearchOpener',
			'AnahataMikadoSideAreaOpener',
			'AnahataMikadoStickySidebar',
			'AnahataMikadoSocialIconWidget',
			'AnahataMikadoSeparatorWidget',
			'AnahataMikadoCallToActionButton',
			'AnahataMikadoHtmlWidget',
			'AnahataMikadoPostCategories'
		);

		if( anahata_mikado_is_plugin_installed('woocommerce') ) {
			$widgets[] = 'AnahataMikadoWoocommerceDropdownCart';
		}

		if( anahata_mikado_is_plugin_installed('contact-form-7') ) {
			$widgets[] = 'AnahataMikadoContactForm7';
		}

		foreach($widgets as $widget) {
			register_widget($widget);
		}
	}
}

add_action('widgets_init', 'anahata_mikado_register_widgets');