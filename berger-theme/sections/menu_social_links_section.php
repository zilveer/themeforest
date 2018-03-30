<?php

global $clapat_bg_theme_options;
global $cpbg_social_links;

echo '<ul class="menu-socials"> ';

for( $idx = 1; $idx <= MAX_SOCIAL_LINKS; $idx++ ){
	
	$social_name = $clapat_bg_theme_options['clapat_bg_social_' . $idx];
	$social_url  = $clapat_bg_theme_options['clapat_bg_social_url_' . $idx];
	
	if( $social_url ){
		echo '<li><a href="' . $social_url . '" target="_blank"><i class="fa fa-' . $social_name . '"></i></a></li>';
	}
	
}

echo '</ul>';
		
?>		