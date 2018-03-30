<?php
/*	
*	---------------------------------------------------------------------
*	MNKY Template part: page title & before content area
*	--------------------------------------------------------------------- 
*/
	

// Logo URLs	
$default_logo = ot_get_option('logo');
$retina_logo = ot_get_option('logo_retina');

// Logo output	
if ($default_logo != ''){
	if ($retina_logo ){
		echo '<a href="'. home_url() .'" class="header-default-css">
				<img src="'. esc_attr($default_logo) .'" alt="', esc_attr(bloginfo('name')) .'" class="default-logo" />
				<img src="'. esc_attr($retina_logo) .'" width="'. esc_attr(str_replace( "px", "", ot_get_option('retina_logo_width') )) .'" height="'. esc_attr(str_replace( "px", "",ot_get_option('retina_logo_height') )) .'" alt="', esc_attr(bloginfo('name')) .'" class="retina-logo" />
			</a>';
	} else {
		echo '<a href="'. esc_url(home_url()) .'" class="header-default-css"><img src="'. esc_attr($default_logo) .'" alt="', esc_attr(bloginfo('name')) .'" /></a>';
	}
} else {
	echo '<h1 class="site-title header-default-css"><a href="'. esc_url(home_url()) .'" title="', esc_attr(bloginfo('name')) .'" rel="home">', bloginfo('name') .'</a></h1>';
}
