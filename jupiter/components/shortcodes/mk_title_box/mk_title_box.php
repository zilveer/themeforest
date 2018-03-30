<?php
$path = pathinfo(__FILE__) ['dirname'];

include ($path . '/config.php');
$id = Mk_Static_Files::shortcode_id();


echo mk_get_fontfamily("#mk-title-box-", $id, $font_family, $font_type);

?>

<h3  id="mk-title-box-<?php echo $id; ?>" class="mk-title-box clearfix <?php echo get_viewport_animation_class($animation).$el_class; ?>">
	<span><?php echo wpb_js_remove_wpautop( $content ); ?></span>
</h3>

<?php
/**
 * Custom CSS Output
 * ==================================================================================
 */
$app_styles = '
	#mk-title-box-'.$id.' {
		font-size: '.$size.'px !important;
		text-align: '.$align.';
		color: '.$color.' !important;
		font-weight: '.$font_weight.';
		letter-spacing: '.$letter_spacing.'px;
		margin-top: '.$margin_top.'px;
		margin-bottom: '.$margin_bottom.'px;
	}
	#mk-title-box-'.$id.' span {
		line-height: '.$line_height.'px;
	}
';

if ( $stroke > 0 ) {
	$stroke_color = $stroke_color ? $stroke_color : $color;
	$app_styles .= '
		#mk-title-box-'.$id.' span {
			border: '.$stroke.'px solid '.$stroke_color.';
			padding-left: '.($line_height / 2.5 ).'px;
			padding-right: '.($line_height / 2.5 ).'px;
			display: inline-block;
		}
	';
}
if ( !empty($highlight_color) ) {
	if ($stroke > 0) {
		$app_styles .= '
			#mk-title-box-'.$id.' span {
				background-color: '.mk_color($highlight_color, $highlight_opacity).';
			}
		';
	}
	else {
		$app_styles .= '
			#mk-title-box-'.$id.' span {
				background-color: '.mk_color($highlight_color, $highlight_opacity).';
				box-shadow: 8px 0 0 ' . mk_color($highlight_color, $highlight_opacity) . ', -8px 0 0 ' . mk_color($highlight_color, $highlight_opacity).';
			}
		';
	}
}

Mk_Static_Files::addCSS($app_styles, $id);
