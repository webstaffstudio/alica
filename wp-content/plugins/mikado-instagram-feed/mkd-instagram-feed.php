<?php
/*
Plugin Name: Mikado Instagram Feed
Description: Plugin that adds Instagram feed functionality to our theme
Author: Mikado Themes
Version: 2.0
*/
define('MIKADO_INSTAGRAM_FEED_VERSION', '2.0');
define('MIKADO_INSTAGRAM_REL_PATH', dirname(plugin_basename(__FILE__ )));

include_once 'load.php';

if ( ! function_exists( 'mikado_instagram_feed_text_domain' ) ) {
	/**
	 * Loads plugin text domain so it can be used in translation
	 */
	function mikado_instagram_feed_text_domain() {
		load_plugin_textdomain( 'mkd-instagram-feed', false, MIKADO_INSTAGRAM_REL_PATH . '/languages' );
	}

	add_action( 'plugins_loaded', 'mikado_instagram_feed_text_domain' );
}
