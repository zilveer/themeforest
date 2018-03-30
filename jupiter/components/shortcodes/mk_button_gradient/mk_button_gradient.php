<?php

$phpinfo =  pathinfo( __FILE__ );
$path = $phpinfo['dirname'];
include( $path . '/config.php' );


$html = file_get_contents( $path . '/template.php' );
$html = phpQuery::newDocument( $html );

$id = Mk_Static_Files::shortcode_id();


$button_container = pq( '.mk-gradient-button' );

$button_container->attr('id', 'mk-gradient-button-'.$id);
$button_container->addClass('fullwidth-'.$fullwidth);
$button_container->addClass('btn-align-'.$align);

if ($button_custom_width > 0 ) {
	$button_container->addClass('custom-width-true');
}
if ( $animation != '' ) {
	$button_container->addClass(get_viewport_animation_class($animation));
}
$button_container->find( 'a' )
				 ->addClass( 'mk-button' );
$button_container->find( 'a' )
				 ->addClass($el_class);
$button_container->find( 'a' )
				 ->addClass('mk-button--dimension-'.$dimension);
$button_container->find( 'a' )
				 ->addClass('mk-button--size-'.$size);
if ($dimension == 'double-outline' || $dimension == 'outline') {
	$button_container->find( 'a' )
				 		  ->addClass( 'mk-button--corner-pointed' );
}else {
	$button_container->find( 'a' )
				 ->addClass('mk-button--corner-'.$corner_style);
}
if ($dimension == 'flat' || $dimension == 'two') {
	$darker_background = '<i class="darker-background"></i>';
}else {
	$darker_background = '';
}

$button_container->find( 'a' )
			     ->addClass($text_color.'-skin');

if($dimension == 'double-outline') {
	$double_outline_border = '<span class="double-outline-inside"></span>';
}else {
	$double_outline_border = '';
}

$button_container->find( 'a' )
	             ->append($darker_background)
	             ->append($double_outline_border)
				 	 ->find( '.text' )
				 	 ->html(strip_tags( $content ));

if( $id_second == '' ) {
	$button_container->find( 'a' )
				     ->attr('href', $url);
}else {
	$button_container->find( 'a' )
				     ->attr('href', $id_second);
}

$button_container->find( 'a' )
				 ->attr('target', $target);





/**
 * Collect JSON config for JS
 * ==================================================================================*/


/**
 * Custom CSS Output
 * ==================================================================================*/


$gradients = mk_gradient_option_parser($grandient_color_style, $grandient_color_angle);

if ($button_custom_width > 0 ) {
	$custom_width = 'width: '.$button_custom_width.'px;';
}else {
	$custom_width = '';
}

Mk_Static_Files::addCSS('
	#mk-gradient-button-'.$id.' {
		margin-top:'.$margin_top.'px;
		margin-bottom:'.$margin_bottom.'px;
		margin-right:'.$margin_right.'px;
    }
	#mk-gradient-button-'.$id.' a {
    	'.$custom_width.'
    	background: '.$grandient_color_fallback.';
		background: -webkit-'.$gradients['type'].'-gradient('.$gradients['angle_1'].''.$grandient_color_from.' 0%, '.$grandient_color_to.' 100%);
		background: '.$gradients['type'].'-gradient('.$gradients['angle_2'].''.$grandient_color_from.' 0%, '.$grandient_color_to.' 100%);
    }
', $id);

if( $dimension == 'outline' || $dimension == 'double-outline') {
	$border_fallback = ($text_color == 'light') ? 'border-color: #ffffff;' : 'border-color: #222222;';
	Mk_Static_Files::addCSS('
		#mk-gradient-button-'.$id.' a {
			-webkit-border-image: -webkit-'.$gradients['type'].'-gradient('.$gradients['angle_1'].''.$grandient_color_from.' 0%, '.$grandient_color_to.' 100%);
			border-image: '.$gradients['type'].'-gradient('.$gradients['angle_2'].''.$grandient_color_from.' 0%, '.$grandient_color_to.' 100%);
			border-image-slice: 1;
			'.$border_fallback.'
	    }
	    #mk-gradient-button-'.$id.' a::after {
	    	background-color: '.$grandient_color_fallback.';
			background: -webkit-'.$gradients['type'].'-gradient('.$gradients['angle_1'].''.$grandient_color_from.' 0%, '.$grandient_color_to.' 100%);
			background: '.$gradients['type'].'-gradient('.$gradients['angle_2'].''.$grandient_color_from.' 0%, '.$grandient_color_to.' 100%);
	    }
	     #mk-gradient-button-'.$id.' a:hover {
			-webkit-text-fill-color: initial;
	    }
	', $id);
	if ($dimension == 'double-outline') {
		Mk_Static_Files::addCSS('
			#mk-gradient-button-'.$id.' a .double-outline-inside {
				-webkit-border-image: -webkit-'.$gradients['type'].'-gradient('.$gradients['angle_1'].''.$grandient_color_from.' 0%, '.$grandient_color_to.' 100%);
				border-image: '.$gradients['type'].'-gradient('.$gradients['angle_2'].''.$grandient_color_from.' 0%, '.$grandient_color_to.' 100%);
				border-image-slice: 1;
				'.$border_fallback.'
		    }
		', $id);
	}
}



if($dimension != 'flat' && $dimension != 'two') {
	Mk_Static_Files::addCSS('
		#mk-gradient-button-'.$id.' a{
			-webkit-background-clip: text;
			-webkit-text-fill-color: transparent;
        }
        @-moz-document url-prefix() {
			#mk-gradient-button-'.$id.' a{
				background: transparent;
	        }
		} 
	', $id);
}


print $html;
