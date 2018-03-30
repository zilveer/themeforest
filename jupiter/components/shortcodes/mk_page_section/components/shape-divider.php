<?php

$html = '<div class="mk-shape-divider mk-shape-divider--stick">
			<div class="shape__container">
				<div class="shape">
				</div>
			</div>
		</div>';


$style = $view_params['style'];
$size = $view_params['size'];
$shape_color = $view_params['shape_color'];
$bg_color = $view_params['bg_color'];
$el_class = $view_params['el_class'];

$html = phpQuery::newDocument( $html );
$id = Mk_Static_Files::shortcode_id();

$pattern_path = $pattern_width = $pattern_width_viewbox = $pattern_height = '';
$shape_box = pq( '.mk-shape-divider' );
$shape_container = $shape_box->find('.shape__container');

$shape_box->attr('id', 'mk-shape-divider-'.$id);

$shape_box->addClass($style.'-style');
$shape_box->addClass($size.'-size');
$shape_box->addClass($el_class);

$is_top = (strpos($style,'-top') !== false) ? false : true;
$stickClass = ($is_top) ? 'mk-shape-divider--stick-bottom' : 'mk-shape-divider--stick-top';
$shape_box->filter('.mk-shape-divider--stick')->addClass($stickClass);

$shape_color = $shape_color !== '' ? $shape_color : 'transparent';

// Shape Svg Settings
if($style == 'diagonal-bottom') {
	if($size == 'small') {
		$pattern_path 			= '<polygon fill="'.$shape_color.'" points="100,70 100,0 0,70 "/>';
		$pattern_width 			= '100%';
		$pattern_width_viewbox 	= '100';
		$pattern_height 		= '70';
	} else if ($size == 'big') {
		$pattern_path 			= '<polygon fill="'.$shape_color.'" points="100,0 100,130 0,130 "/>';
		$pattern_width 			= '100%';
		$pattern_width_viewbox 	= '100';
		$pattern_height 		= '130';
	}
} else if($style == 'diagonal-top') {
	if($size == 'small') {
		$pattern_path 			= '<polygon fill="'.$shape_color.'" points="0,0 0,70 100,0 "/>';
		$pattern_width 			= '100%';
		$pattern_width_viewbox 	= '100';
		$pattern_height 		= '70';
	} else if ($size == 'big') {
		$pattern_path 			= '<polygon fill="'.$shape_color.'" points="0,130 0,0 100,0 "/>';
		$pattern_width 			= '100%';
		$pattern_width_viewbox 	= '100';
		$pattern_height 		= '130';
	}
} else if($style == 'jagged-bottom') {
	if($size == 'small') {
		$pattern_path 			= '<polygon fill="'.$shape_color.'" points="10.5,5 5.497,0 0.5,4.994 "/>';
		$pattern_width 			= '11px';
		$pattern_width_viewbox 	= '11';
		$pattern_height 		= '5';
	} else if ($size == 'big') {
		$pattern_path 			= '<polygon fill="'.$shape_color.'" points="20.501,10 10.495,0 0.5,9.989 "/>';
		$pattern_width 			= '21px';
		$pattern_width_viewbox 	= '21';
		$pattern_height 		= '10';
	}
} else if($style == 'jagged-top') {
	if($size == 'small') {
		$pattern_path			= '<polygon fill="'.$shape_color.'" points="0.5,0 10.5,0 5.5,5 "/>';
		$pattern_width 			= '11px';
		$pattern_width_viewbox 	= '11';
		$pattern_height 		= '5';
	} else if ($size == 'big') {
		$pattern_path 			= '<polygon fill="'.$shape_color.'" points="0.5,0 10.506,10 20.501,0.011 "/>';
		$pattern_width 			= '21px';
		$pattern_width_viewbox 	= '21';
		$pattern_height 		= '10';
	}
} else if($style == 'jagged-rounded-bottom') {
	if($size == 'small') {
		$pattern_path 			= '<path fill="'.$shape_color.'" d="M2.244,1.344C1.615,0.55,0.893,0.07,0,0.07V3h7V0.07c-0.894,0-1.614,0.48-2.243,1.274C4.023,2.269,2.977,2.269,2.244,1.344"/>';
		$pattern_width 			= '7px';
		$pattern_width_viewbox 	= '7';
		$pattern_height 		= '3';
	} else if ($size == 'big') {
		$pattern_path 			= '<path fill="'.$shape_color.'" d="M5.944,3.146C4.415,1.213,2.174,0,0,0v6h18V0c-2.175,0-4.414,1.213-5.944,3.146C10.271,5.397,7.729,5.397,5.944,3.146"/>';
		$pattern_width 			= '18px';
		$pattern_width_viewbox 	= '18';
		$pattern_height 		= '6';
	}
} else if($style == 'jagged-rounded-top') {
	if($size == 'small') {
		$pattern_path 			= '<path fill="'.$shape_color.'" d="M4.755,1.656C5.384,2.451,6.107,2.93,7,2.93V0H0v2.93c0.894,0,1.614-0.48,2.243-1.274C2.976,0.731,4.023,0.731,4.755,1.656"/>';
		$pattern_width 			= '7px';
		$pattern_width_viewbox 	= '7';
		$pattern_height 		= '3';
	} else if ($size == 'big') {
		$pattern_path 			= '<path fill="'.$shape_color.'" d="M12.056,2.855C13.586,4.788,15.826,6,18,6V0H0v6c2.175,0,4.414-1.213,5.944-3.146C7.729,0.604,10.271,0.604,12.056,2.855" />';
		$pattern_width 			= '18px';
		$pattern_width_viewbox 	= '18';
		$pattern_height 		= '6';
	}
} else if($style == 'folded-bottom') {
	if($size == 'small') {
		$pattern_path 			= '<polygon fill="'.$shape_color.'" points="0,0 0,84 50,84 100,84 100,0 50,84 "/>';
		$pattern_width 			= '100%';
		$pattern_width_viewbox 	= '100';
		$pattern_height 		= '85';
	} else if ($size == 'big') {
		$pattern_path 			= '<polygon fill="'.$shape_color.'" points="0,0 0,130 50,130 "/><polygon fill="'.$shape_color.'" points="100,0 100,130 50,130 "/>';
		$pattern_width 			= '100%';
		$pattern_width_viewbox 	= '100';
		$pattern_height 		= '130';
	}
} else if($style == 'folded-top') {
	if($size == 'small') {
		$pattern_path 			= '<polygon fill="'.$shape_color.'" points="100,85 100,0 50,0 "/><polygon fill="'.$shape_color.'" points="0,85 0,0 50,0 "/>';
		$pattern_width 			= '100%';
		$pattern_width_viewbox 	= '100';
		$pattern_height 		= '85';
	} else if ($size == 'big') {
		$pattern_path 			= '<polygon fill="'.$shape_color.'" points="100,130 100,0 50,0 "/><polygon fill="'.$shape_color.'" points="0,130 0,0 50,0 "/>';
		$pattern_width 			= '100%';
		$pattern_width_viewbox 	= '100';
		$pattern_height 		= '130';
	}
} else if($style == 'curve-bottom') {
	if($size == 'small') {
		$pattern_path			= '<path fill="'.$shape_color.'" d="M0,0v30h100V0c0,0,0,28-50,28S0,0,0,0z"/>';
		$pattern_width 			= '100%';
		$pattern_width_viewbox 	= '100';
		$pattern_height 		= '30';
	} else if ($size == 'big') {
		$pattern_path			= '<path fill="'.$shape_color.'" d="M0,0v80h100V0c0,0,0,78-50,78S0,0,0,0z"/>';
		$pattern_width 			= '100%';
		$pattern_width_viewbox 	= '100';
		$pattern_height 		= '80';
	}
} else if($style == 'curve-top') {
	if($size == 'small') {
		$pattern_path			= '<path fill="'.$shape_color.'" d="M100,30V0H0v30C0,30,0,2,50,2S100,30,100,30z"/>';
		$pattern_width 			= '100%';
		$pattern_width_viewbox 	= '100';
		$pattern_height 		= '30';
	} else if ($size == 'big') {
		$pattern_path			= '<path fill="'.$shape_color.'" d="M100,80V0H0v80C0,80,0,2,50,2S100,80,100,80z"/>';
		$pattern_width 			= '100%';
		$pattern_width_viewbox 	= '100';
		$pattern_height 		= '80';
	}
}

// Shape Svg Added
if($style !== 'speech-bottom' && $style !== 'speech-top') {
	$shape_container->find('.shape')->append('
		<svg width="100%" height="'.$pattern_height.'px">
			<defs>
			    <pattern id="shapeDividerPattern-'.$id .'" preserveAspectRatio="none" style="background-repeat: none;" patternUnits="userSpaceOnUse" x="0" y="0" width="'.$pattern_width.'" height="'.$pattern_height.'0px" viewBox="0 0 '.$pattern_width_viewbox.' '.$pattern_height.'0" >
			        '.$pattern_path.'
			    </pattern>
			</defs>

			<!-- Background -->
			<rect x="0" y="0" width="100%" height="'.$pattern_height.'px" fill="url(#shapeDividerPattern-'.$id .')" />
		</svg>
	');
} else {
	$shape_container->find('.shape')->append('
		<div class="speech-left"></div><div class="speech-right"></div>
		<div class="clearfix"></div>
	');
}

/**
 * Custom CSS Output
 * ==================================================================================*/
Mk_Static_Files::addCSS('
	#mk-shape-divider-'.$id.' .shape__container {
 		background-color: '.$bg_color.';
 	}
	/* @-moz-document url-prefix() { */
		#mk-shape-divider-'.$id.' .shape__container .shape {
			overflow: hidden;
			height: '.$pattern_height.';
		}
	/* } */
 ', $id);

if($is_top == true) {
	Mk_Static_Files::addCSS('
		/* @-moz-document url-prefix() { */
			#mk-shape-divider-'.$id.' .shape__container .shape svg {
				position: relative;
				top: 0.4px;
			}
		/* } */
	', $id);
} else {
	Mk_Static_Files::addCSS('
		/* @-moz-document url-prefix() { */
			#mk-shape-divider-'.$id.' .shape__container .shape svg {
				position: relative;
				top: -0.4px;
			}
		/* } */
	', $id);
}

if($style == 'speech-bottom' || $style == 'speech-top') {
	Mk_Static_Files::addCSS('
		#mk-shape-divider-'.$id.' .shape__container .shape .speech-left,
		#mk-shape-divider-'.$id.' .shape__container .shape .speech-right {
			background-color: '.$shape_color.';
		}
	', $id);
}


print $html;
?>