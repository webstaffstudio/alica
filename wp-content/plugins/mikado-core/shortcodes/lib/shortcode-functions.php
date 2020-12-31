<?php

if(!function_exists('anahata_mikado_remove_auto_ptag')) {
	function anahata_mikado_remove_auto_ptag($content, $autop = false) {
		if($autop) {
            $content = preg_replace('#^<\/p>|<p>$#', '', $content);
		}

		return do_shortcode($content);
	}
}