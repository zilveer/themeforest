<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta class="viewport" name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php esc_url(bloginfo( 'pingback_url' )); ?>" />
	
	<!-- == Favicons  using action wp_head == -->
	
	<!--[if lt IE 9]>
		<script src="<?php echo esc_url( SAMA_THEME_URI. '/js/ie/html5shiv.js' );?>"></script>
		<script src="<?php echo esc_url( SAMA_THEME_URI. '/js/ie/respond.min.js' );?>"></script>
    <![endif]-->
	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php 
		// Display Loader
		global $majesty_options;
		if( $majesty_options['display_loader'] ) {
			$loader = $majesty_options['loader_style'];
			$loader_logo = $majesty_options['loader_logo'];
	?>
			<div id="<?php echo esc_attr($loader); ?>">
				<div class="loader-item">
					<img src="<?php echo esc_url( $loader_logo ); ?>" alt="Logo">
					<?php if( $loader == 'loader3' ) { ?>
						<div class="spinner">
							<div class="dot1"></div><div class="dot2"></div>
						</div>
					<?php } elseif( $loader == 'loader3' ) { ?>
						<div class="sk-spinner sk-spinner-wave">
							<div class="sk-rect1"></div><div class="sk-rect2"></div><div class="sk-rect3"></div><div class="sk-rect4"></div>
							<div class="sk-rect5"></div>
						</div>
					<?php } else { ?>
						<div class="spinner">
							<div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div>
						</div>
					<?php } ?>
				</div>
			</div>
	<?php
		} // End Display Loader
	?>

    <div id="wrapper">
		
		<?php
			// Display top small header
			if( ! is_page_template( 'page-templates/page-blank.php' )  ) {
				if( $majesty_options['enable_small_hedaer'] ) {
					get_template_part( 'header-menu/top-small-header' );	
				} elseif( ! empty( $majesty_options['pages_display_small_header'] ) && in_array( sama_get_current_page_id(), $majesty_options['pages_display_small_header']) ) {
					get_template_part( 'header-menu/top-small-header' );
				}
			}
			
			// Display Top Slider
			do_action('sama_before_top_menu');
			
			// display menu
			if( ! is_page_template( 'page-templates/page-blank.php' )  ) {
				get_template_part( 'header-menu/theme-menu' );	
			}
		?>
		<div id="content">