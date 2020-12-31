<?php

if(!function_exists('anahata_mikado_is_responsive_on')) {
	/**
	 * Checks whether responsive mode is enabled in theme options
	 * @return bool
	 */
	function anahata_mikado_is_responsive_on() {
		return anahata_mikado_options()->getOptionValue('responsiveness') !== 'no';
	}
}