<?php
$root = dirname(dirname(dirname(dirname(dirname(__FILE__)))));
if ( file_exists( $root.'/wp-load.php' ) ) {
    require_once( $root.'/wp-load.php' );
//    require_once( $root.'/wp-config.php' );
} else {
	$root = dirname(dirname(dirname(dirname(dirname(dirname(__FILE__))))));
	if ( file_exists( $root.'/wp-load.php' ) ) {
    require_once( $root.'/wp-load.php' );
//    require_once( $root.'/wp-config.php' );
	}
}
header("Content-type: text/css; charset=utf-8");
?>
@media only screen and (max-width: 1000px){
	<?php if (!empty($qode_options['header_background_color'])) { ?>
	.header_bottom {
		background-color: <?php echo esc_attr($qode_options['header_background_color']);  ?>;
	}
	<?php } ?>
	<?php if (!empty($qode_options['mobile_background_color'])) { ?>
		.header_bottom,
		nav.mobile_menu{
				background-color: <?php echo esc_attr($qode_options['mobile_background_color']);  ?> !important;
		}
	<?php } ?>
	<?php if (!empty($qode_options['vertical_mobile_background_color'])) { ?>
		.header_bottom,
		nav.mobile_menu{
			background-color: <?php echo esc_attr($qode_options['vertical_mobile_background_color']);  ?> !important;
		}
	<?php } ?>
}
@media only screen and (min-width: 480px) and (max-width: 768px){
	
	<?php if (isset($qode_options['parallax_minheight']) && !empty($qode_options['parallax_minheight'])) { ?>
        section.parallax_section_holder{
			height: auto !important;
			min-height: <?php echo esc_attr($qode_options['parallax_minheight']); ?>px;
		}
	<?php } ?>
	
	<?php if (isset($qode_options['header_background_color_mobile']) &&  !empty($qode_options['header_background_color_mobile'])) { ?>
		header{
			 background-color: <?php echo esc_attr($qode_options['header_background_color_mobile']);  ?> !important;
			 background-image:none;
		}
	<?php } ?>
}

@media only screen and (max-width: 480px){
	
	<?php if (isset($qode_options['parallax_minheight']) && !empty($qode_options['parallax_minheight'])) { ?>
		section.parallax_section_holder{
			height: auto !important;
			min-height: <?php echo esc_attr($qode_options['parallax_minheight']); ?>px;
		}
	<?php } ?>
	
	<?php if (isset($qode_options['header_background_color_mobile']) &&  !empty($qode_options['header_background_color_mobile'])) { ?>
		header{
			 background-color: <?php echo esc_attr($qode_options['header_background_color_mobile']);  ?> !important;
			 background-image:none;
		}
	<?php } ?>
}