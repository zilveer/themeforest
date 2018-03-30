<?php
$phpinfo =  pathinfo( __FILE__ );
$path = $phpinfo['dirname'];
include( $path . '/config.php' );

$id = Mk_Static_Files::shortcode_id();

$border_style = $border_single_style = $border_gradient_style =  '';

if($style == 'thick_solid' || $style == 'single_dotted') {
	$border_style .= ($border_color != '') ? ('border-top-color:'.$border_color.';') : '';
}


if ($style == 'thin_solid') {
	if(!empty($border_color)) {
		$border_style .= ($border_color != '') ? ('border-top-color:'.$border_color.';') : '';
	}else {
		if($thin_color_style == 'single_color' || $thin_color_style == 'gradient_color') {
			if ($thin_color_style == 'single_color') {
				$border_single_style = ($thin_single_color != '') ? ('border-top-color:'.$thin_single_color.';') : '';
			}else if($thin_color_style == 'gradient_color') {
				$border_gradient_style = '';
				$gradients_border = mk_gradient_option_parser($thin_gradient_color_style, $thin_gradient_color_angle);
				$border_gradient_style .= 'background: '.$thin_grandient_color_fallback.';';
				$border_gradient_style .= 'background: -webkit-'.$gradients_border['type'].'-gradient('.$gradients_border['angle_1'].''.$thin_grandient_color_from.' 0%, '.$thin_grandient_color_to.' 100%);';
				$border_gradient_style .= 'background: '.$gradients_border['type'].'-gradient('.$gradients_border['angle_2'].''.$thin_grandient_color_from.' 0%, '.$thin_grandient_color_to.' 100%);';
				$border_gradient_style .= 'height: '.$thickness.'px;';
				$border_gradient_style .= 'top: -'.$thickness.'px;';
				$border_gradient_style .= 'content: "";';
			}
		}
	}
}

if($style == 'thin_solid') {
	$border_style .= ($thickness != '') ? ('border-top-width:'.$thickness.'px;') : '';
}

$custom_width_style = ( $divider_width == 'custom_width' ) ? 'width:'.$custom_width.'px' : '';

Mk_Static_Files::addCSS("
	#divider-{$id} {
		padding:{$margin_top}px 0 {$margin_bottom}px;
	}
	#divider-{$id} .divider-inner {
		{$border_style}
		{$border_single_style}
		{$custom_width_style}
	}
	#divider-{$id} .divider-inner:after {
		{$border_gradient_style}
	}
", $id);


if ( $style == 'shadow_line' ) {
	$theme_images = THEME_IMAGES;
	Mk_Static_Files::addCSS("
		#divider-{$id} .divider-shadow-left,
	   #divider-{$id} .divider-shadow-right {
			background-image: url({$theme_images}/shadow-divider.png);
		}
	", $id);
}

$class[] = 'mk-divider';
$class[] = get_viewport_animation_class($animation);
$class[] = $visibility;
$class[] = $el_class;

?>
<div id="divider-<?php echo $id; ?>" class="<?php echo implode(' ', $class); ?> <?php if ($divider_width == 'custom_width') { ?>custom-width<?php } else { ?> divider_<?php echo $divider_width; } ?> <?php echo $align; ?> <?php echo $style; ?> <?php echo $visibility; ?> <?php echo $el_class; ?>">

	<?php if ( $style == 'shadow_line' ) { ?>
		<div class="divider-inner"><span class="divider-shadow-left"></span><span class="divider-shadow-right"></span></div>

	<?php } elseif ( $style == 'go_top' || $style == 'go_top_thick' ) { ?>
		<div class="divider-inner">
			<a href="#top-of-page" class="divider-go-top page-bg-color "><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true,'mk-jupiter-icon-arrow-top', 16); ?></a>
		</div>

	<?php } else { ?>
		<div class="divider-inner"></div>
	<?php } ?>

</div>
<div class="clearboth"></div>
