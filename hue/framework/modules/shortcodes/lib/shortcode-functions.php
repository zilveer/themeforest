<?php

if(!function_exists('hue_mikado_remove_auto_ptag')) {
	function hue_mikado_remove_auto_ptag($content, $autop = false) {
		if($autop) {
            $content = preg_replace('#^<\/p>|<p>$#', '', $content);
		}

		return do_shortcode($content);
	}
}