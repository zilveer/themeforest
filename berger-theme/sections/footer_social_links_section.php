<?php

global $clapat_bg_theme_options;
global $cpbg_social_links;

if( $clapat_bg_theme_options['clapat_bg_footer_layout'] == 'v1' ){

    echo '<ul class="text-socials"> ';
} else if( $clapat_bg_theme_options['clapat_bg_footer_layout'] == 'v2' ){

    echo '<ul class="text-socials-minimal">';
    echo '<li>' . $clapat_bg_theme_options['clapat_bg_footer_socials_prefix'] . '</li>';
} else if( $clapat_bg_theme_options['clapat_bg_footer_layout'] == 'v3' ){

    echo '<ul class="footer-socials">';
}
else{

    echo '<ul>';
}

for( $idx = 1; $idx <= MAX_SOCIAL_LINKS; $idx++ ){
	
	$social_name = $clapat_bg_theme_options['clapat_bg_social_' . $idx];
	$social_url  = $clapat_bg_theme_options['clapat_bg_social_url_' . $idx];
	
	if( $social_url ){
        if( $clapat_bg_theme_options['clapat_bg_footer_layout'] == 'v3' ){
		    echo '<li><a href="' . $social_url . '" target="_blank"><i class="fa fa-' . $social_name . '"></i></a></li>';
        }
        else{
            echo '<li><a href="' . $social_url . '" target="_blank">' . $social_name . '</a></li>';
        }
	}
	
}

echo '</ul>';
		
?>		