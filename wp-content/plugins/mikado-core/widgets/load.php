<?php

if(!function_exists('anahata_mikado_load_widget_class')) {
	/**
	 * Loades widget class file.
	 *
	 */
	function anahata_mikado_load_widget_class() {
		include_once 'widget-class.php';
	}

	add_action('anahata_mikado_before_options_map', 'anahata_mikado_load_widget_class',9); //9 is because of the cf7 widget that is loaded from module
}

if(!function_exists('anahata_mikado_load_widgets')) {
	/**
	 * Loades all widgets by going through all folders that are placed directly in widgets folder
	 * and loads load.php file in each. Hooks to anahata_mikado_after_options_map action
	 */
	function anahata_mikado_load_widgets() {

		foreach(glob(MIKADO_CORE_ABS_PATH.'/widgets/*/load.php') as $widget_load) {
			include_once $widget_load;
		}

		include_once 'widget-loader.php';
	}

	add_action('anahata_mikado_before_options_map', 'anahata_mikado_load_widgets');
}