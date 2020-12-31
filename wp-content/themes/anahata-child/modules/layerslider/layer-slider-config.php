<?php
if(!function_exists('anahata_mikado_layerslider_overrides')) {
	/**
	 * Disables Layer Slider auto update box
	 */
	function anahata_mikado_layerslider_overrides() {
		$GLOBALS['lsAutoUpdateBox'] = false;
	}

	add_action('layerslider_ready', 'anahata_mikado_layerslider_overrides');
}
?>