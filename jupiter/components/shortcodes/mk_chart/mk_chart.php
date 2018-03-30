<?php
global $mk_options;

$phpinfo =  pathinfo( __FILE__ );
$path = $phpinfo['dirname'];
include( $path . '/config.php' );

$html = file_get_contents( $path . '/template.php' );
$html = phpQuery::newDocument( $html );
$id = Mk_Static_Files::shortcode_id();

$icon = (strpos($icon, 'mk-') !== FALSE) ? $icon : ( 'mk-'.$icon.'' );

$container = pq('.mk-chart');
$containerChart = $container->find('.mk-chart__chart');
$containerDesc =  $container->find('.mk-chart__desc');

$container->attr('id', 'mk-chart-'.$id);
$container->addClass($el_class);
$container->addClass($visibility);

$containerChart->attr('data-percent', $percent);
$containerChart->attr('data-barColor', $bar_color);
$containerChart->attr('data-trackColor', $track_color);
$containerChart->attr('data-lineWidth', $line_width);
$containerChart->attr('data-barSize', $bar_size);

if ( $animation != '' ) {
	$container->addClass(get_viewport_animation_class($animation));
}
if ( $content_type == 'icon' ) {
	$icon_size = (!empty($icon_size)) ? $icon_size : floor( $bar_size/4 );
	$icon_color =  (!empty($icon_color)) ? $icon_color : '#444';

	$containerChart->append(Mk_SVG_Icons::get_svg_icon_by_class_name(false, $icon));

}else if($content_type == 'custom_text') {
	$containerChart->append('<span class="mk-chart__text"></span>')
			->find('.mk-chart__text')
			->html($custom_text);
}else if($content_type == 'percent') {
	$containerChart->append('<span class="mk-chart__percent"></span>')
			->find('.mk-chart__percent')
			->html($percent);
}

$containerDesc->html($desc);


/**
 * Custom CSS Output
 * ==================================================================================
 */
 $app_styles = '
	#mk-chart-'.$id.' .mk-chart__chart {
		height: '.$bar_size.'px;
		width: '.$bar_size.'px;
	}
	#mk-chart-'.$id.' .mk-chart__desc {
		color:'.$desc_color.';
		font-size:'.$desc_text_size.'px;
	}
';
if ( $content_type == 'icon' ) {
	 $app_styles .= '
		#mk-chart-'.$id.' svg {
			height: '.$icon_size.'px;
			fill: '.$icon_color.';
    		vertical-align: middle;
		}
	';

}else if($content_type == 'custom_text') {
	$app_styles .= '
		#mk-chart-'.$id.' .mk-chart__text {
			font-size: '.$custom_text_size.'px;
		}
	';

}else if($content_type == 'percent'){
	 $app_styles .= '
		#mk-chart-'.$id.' .mk-chart__percent {
			color: '.$percentage_color.';
			font-size: '.$percentage_text_size.'px;
		}
	';
}

Mk_Static_Files::addCSS($app_styles, $id);

print $html;
