<?php

if(anahata_mikado_the_events_calendar_installed()) {
    include_once MIKADO_CORE_ABS_PATH.'/shortcodes/events-list/events-list.php';

//	function test() {
//		$shortcode_loader = \Anahata\Modules\Shortcodes\Lib\ShortcodeLoader::getInstance();
//
//		$shortcode_loader->addShortcode(new \Anahata\Modules\Shortcodes\EventsList\EventsList());
//	}
//
//	add_action('anahata_mikado_before_shortcodes_load', 'test');
}

