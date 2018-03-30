<?php

$phpinfo =  pathinfo( __FILE__ );
$path = $phpinfo['dirname'];
include( $path . '/config.php' );

$html = file_get_contents( $path . '/template.php' );
$html = phpQuery::newDocument( $html );

$id = Mk_Static_Files::shortcode_id();


// Main logic here
$box_container = pq( '.mk-iconBox-gradient' );
$box_container->attr( 'id', 'iconBox-gr-'.$id );
$box_container->addClass($el_class);

//icon
$box_container->find('.icon')->find('i')->append(Mk_SVG_Icons::get_svg_icon_by_class_name(false, $icon, $icon_size));

$box_container->find( '.icon' )
			  	  ->addClass( $holder_shape );
$box_container->find( '.icon' )
			  	  ->addClass( 'size-'.$icon_size );

if ( $animation != '' ) {
	$box_container->addClass(get_viewport_animation_class($animation));
}
// svg
$box_container->find( '.icon' )
				->find( 'svg' );

//title
if ( !empty( $read_more_url ) ) {
	$box_container->find('.title')
	              ->html('<a href="'.$read_more_url.'">'.$title.'</a>');
} else {
	$box_container->find('.title')
	              ->html($title);
}

//content
$box_container->find('.content')
				  ->find('p')
				  ->html($content);
/**
 * Custom CSS Output
 * ==================================================================================*/
if($holder_shape == 'circle') {
	$svg = pq( '#iconBox-gr-'.$id )->find( '.icon' )
											->find( 'svg' )
											->attr('viewBox', '0 0 101 101');
}else if ($holder_shape == 'hexagon') {
	$svg = pq( '#iconBox-gr-'.$id )->find( '.icon' )
											->find( 'svg' )
											->attr('viewBox', '0 -6 100 100');
}else if ($holder_shape == 'hexagon2') {
	$svg = pq( '#iconBox-gr-'.$id )->find( '.icon' )
											->find( 'svg' )
											->attr('viewBox', '-5 0 100 100');
}else if ($holder_shape == 'pentagon') {
	$svg = pq( '#iconBox-gr-'.$id )->find( '.icon' )
											->find( 'svg' )
											->attr('viewBox', '0 -2 100 100');
}else if ($holder_shape == 'square') {
	$svg = pq( '#iconBox-gr-'.$id )->find( '.icon' )
											->find( 'svg' )
											->attr('viewBox', '0 0 102 102');
}else if ($holder_shape == 'square2') {
	$svg = pq( '#iconBox-gr-'.$id )->find( '.icon' )
											->find( 'svg' )
											->attr('viewBox', '-1 -1 100 100');
}else if ($holder_shape == 'starz') {
	$svg = pq( '#iconBox-gr-'.$id )->find( '.icon' )
											->find( 'svg' )
											->attr('viewBox', '0 0 100 100');
}

if( $color_style == 'gradient_color' ){
	$svg = pq( '#iconBox-gr-'.$id )->find( '.icon' )
											->find( 'svg' );
	if ( $grandient_color_style == 'linear' ) {
		$box_container->find( '.icon' )
						  ->addClass( 'linear-gradient' );
		$svg->find( 'lineargradient' )
			->attr('id', 'lineargradient-'.$id);
		
		$svg->find( 'lineargradient' )
			->find( '#start_color' )
			->attr( 'stop-color', $grandient_color_from );
		$svg->find( 'lineargradient' )
				->find( '#end_color' )
				->attr( 'stop-color', $grandient_color_to );
		if ( $grandient_color_angle == 'vertical' ) {
			$svg->find( 'lineargradient' )
				->attr( 'gradientTransform', 'rotate(90)' );
			$svg->find( 'lineargradient' )
				->find( '#end_color' )
				->attr( 'offset', '100%' );
		}else if( $grandient_color_angle == 'horizontal' ) {
			$svg->find( 'lineargradient' )
				->attr( 'gradientTransform', 'rotate(0)' );
			$svg->find( 'lineargradient' )
				->find( '#end_color' )
				->attr( 'offset', '100%' );
		}else if( $grandient_color_angle == 'diagonal_left_bottom' ) {
			$svg->find( 'lineargradient' )
				->attr( 'gradientTransform', 'rotate(45)' );
			$svg->find( 'lineargradient' )
				->find( '#end_color' )
				->attr( 'offset', '100%' );
		}else if( $grandient_color_angle == 'diagonal_left_top' ) {
			$svg->find( 'lineargradient' )
				->attr( 'gradientTransform', 'rotate(-45)' );
			$svg->find( 'lineargradient' )
				->find( '#end_color' )
				->attr( 'offset', '50%' );
		}

		Mk_Static_Files::addCSS('
			#iconBox-gr-'.$id.' .icon svg:not(.mk-svg-icon) path {
		    	fill:url(#lineargradient-'.$id.');
		   }
		', $id); 
	}else if ( $grandient_color_style == 'radial' ) {
		$svg->find( 'radialgradient' )
			->attr('id', 'radialgradient-'.$id);
		$box_container->find( '.icon' )
						->addClass( 'radial-gradient' );
		$svg->find( 'radialgradient' )
				->find( '#start_color' )
				->attr( 'stop-color', $grandient_color_from );
		$svg->find( 'radialgradient' )
				->find( '#end_color' )
				->attr( 'stop-color', $grandient_color_to );

		Mk_Static_Files::addCSS('
			#iconBox-gr-'.$id.' .icon svg:not(.mk-svg-icon) path {
		    	fill:url(#radialgradient-'.$id.');
		   }
		', $id);
	}
}else if($color_style == 'single_color') {
	Mk_Static_Files::addCSS('
		#iconBox-gr-'.$id.' .icon svg:not(.mk-svg-icon) path {
	    	fill: '.$container_color.';
	   }
	   #iconBox-gr-'.$id.' .icon svg:not(.mk-svg-icon):hover path {
			fill: '.$container_hover_color.'
		}
	', $id);
}
Mk_Static_Files::addCSS('
	#iconBox-gr-'.$id.' {
		text-align: '.$align.';
	}
	#iconBox-gr-'.$id.' .icon i svg {
		fill: '.$icon_color.';
	}
	#iconBox-gr-'.$id.' .title {
		padding-top: '.$title_top_padding.'px;
		padding-bottom: '.$title_bottom_padding.'px;
		font-weight: '.$title_weight.';
		font-size: '.$title_size.'px;
		color: '.$title_color.';
	}
	#iconBox-gr-'.$id.' .title a {
		color: '.$title_color.';
	}
	#iconBox-gr-'.$id.' .content p {
		color: '.$content_color.';
	}
	#iconBox-gr-'.$id.' .icon:hover i svg {
		svg: '.$icon_hover_color.'; 
	}
	.mk-iconBox-gradient .icon {
		border-radius: 50%;
	}
	.Chrome .mk-iconBox-gradient .icon.'.$holder_shape.',
	.Safari .mk-iconBox-gradient .icon.'.$holder_shape.' {
		border-radius: initial;
	  -webkit-mask: url('.THEME_IMAGES.'/shape/'.$holder_shape.'.svg) top right / 100% 100%;
	}
', $id);

if($color_style == 'single_color') {
	Mk_Static_Files::addCSS('
		#iconBox-gr-'.$id.' .icon {
			background-color: '.$container_color.';
		}
		#iconBox-gr-'.$id.' .icon:hover {
			background-color: '.$container_hover_color.';
		}
	', $id);
}else {
	$gradients = mk_gradient_option_parser($grandient_color_style, $grandient_color_angle);
	Mk_Static_Files::addCSS('
		#iconBox-gr-'.$id.' .icon {
	    	background: '.$grandient_color_fallback.';
			background: -webkit-'.$gradients['type'].'-gradient('.$gradients['angle_1'].''.$grandient_color_from.' 0%, '.$grandient_color_to.' 100%);
			background: '.$gradients['type'].'-gradient('.$gradients['angle_2'].''.$grandient_color_from.' 0%, '.$grandient_color_to.' 100%);
	    }

		.Firefox #iconBox-gr-'.$id.' .icon,
		.Edge #iconBox-gr-'.$id.' .icon,
		.IE #iconBox-gr-'.$id.' .icon {
	    	background: '.$grandient_color_fallback.';
		}
	', $id);
}

print $html;
