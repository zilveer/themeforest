<!DOCTYPE html>
<!--[if IE 6]><html id="ie6" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 7]><html id="ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html id="ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>><!--<![endif]-->
<head>
	
	<meta charset="utf-8" />
	<?php $detect = new Mobile_Detect();
	if ((ot_get_option('responsive_layout') == 'responsive_mobile' && !$detect->isTablet()) || ot_get_option('responsive_layout') == 'responsive_all') { 
		echo '<meta name="viewport" content="width=device-width, initial-scale=1" />';
	} ?>

	<title><?php bloginfo('name'); ?>  <?php wp_title('-'); ?></title>
	
	<?php if (ot_get_option('favicon')){
		echo '<link rel="shortcut icon" href="'. ot_get_option('favicon') .'" />';
	} 

	if (ot_get_option('ipad_retina_icon')){
		echo '<link rel="apple-touch-icon" sizes="144x144" href="'. ot_get_option('ipad_retina_icon') .'" >';
	} 

	if (ot_get_option('iphone_retina_icon')){
		echo '<link rel="apple-touch-icon" sizes="114x114" href="'. ot_get_option('iphone_retina_icon') .'" >';
	}

	if (ot_get_option('ipad_icon')){
		echo '<link rel="apple-touch-icon" sizes="72x72" href="'. ot_get_option('ipad_icon') .'" >';
	} 

	if (ot_get_option('iphone_icon')){
		echo '<link rel="apple-touch-icon" href="'. ot_get_option('iphone_icon') .'" >';
	} ?>
	
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" />

	<!--[if IE 7 ]>
	<link href="<?php echo MNKY_CSS ?>/ie7.css" media="screen" rel="stylesheet" type="text/css">
	<![endif]-->
	<!--[if IE 8 ]>
	<link href="<?php echo MNKY_CSS ?>/ie8.css" media="screen" rel="stylesheet" type="text/css">
	<![endif]-->
	<!--[if lte IE 6]>
	<div id="ie-message">Your browser is obsolete and does not support this webpage. Please use newer version of your browser or visit <a href="http://www.ie6countdown.com/" target="_new">Internet Explorer 6 countdown page</a>  for more information. </div>
	<![endif]-->

	<?php echo ot_get_option('analytics_code'); ?>  
	<?php wp_head(); ?>
</head>
<body <?php body_class('default-header'); ?>>
<!-- Layout wrapper -->
	<div id="layout-wrapper" class="<?php echo ot_get_option('theme_layout', 'full-width'); ?>">

<!-- Top bar -->
	<?php if(ot_get_option('top_bar')) {
		echo '<div id="top-bar-wrapper">
			<div id="top-bar">';
				get_sidebar('top-left'); 
				get_sidebar('top-right');
			echo '<div class="clear"></div>
			</div>
		</div>';
	} ?>
		
<!-- Header -->
	<div id="header-wrapper">
		<div id="header" class="size-wrap">
			
			<div id="logo">
				<?php 
				$default_logo = ot_get_option('logo_upload');
				$retina_logo = ot_get_option('retina_logo_upload');
				if (!$default_logo){
					echo '<a href="'. home_url() .'">
							<h1>', bloginfo('name') .'</h1>
						</a>';
				} else {
					if ($retina_logo){
						$retina_logo_width = ot_get_option('retina_logo_width');
						$retina_logo_width = str_replace("px", "", $retina_logo_width);
						$retina_logo_height = ot_get_option('retina_logo_height');
						$retina_logo_height = str_replace("px", "", $retina_logo_height);
						echo '<a href="'. home_url() .'">
							<img src="'. $default_logo .'" alt="', bloginfo('name') .'" class="default-logo" />
							<img src="'. $retina_logo .'" width="'. $retina_logo_width .'" height="'. $retina_logo_height .'" alt="', bloginfo('name') .'" class="retina-logo" />
						</a>';
					} else {
						echo '<a href="'. home_url() .'">
							<img src="'. $default_logo .'" alt="', bloginfo('name') .'" />
						</a>';
					}
				}
				
				?>
			</div>
			
			<?php get_sidebar('header') ?>
			<div id="menu-wrapper">
				<?php if (!ot_get_option('header_search')) { ?>
					<a class="toggleMenu" href="#"><?php _e('Menu', 'kickstart'); ?><span></span><div class="clear"></div></a>
					<?php wp_nav_menu( array('theme_location' => 'primary', 'container' => false, 'items_wrap' => '<ul id="primary-main-menu" class=%2$s>%3$s<li class="header-search-toggle"><a href="#">'. __('Search', 'kickstart') .'</a></li></ul>', 'fallback_cb' => false)); ?>
				<?php } else { ?>
					<a class="toggleMenu" href="#"><?php _e('Menu', 'kickstart'); ?><span></span><div class="clear"></div></a>
					<?php wp_nav_menu( array('theme_location' => 'primary', 'container' => false, 'items_wrap' => '<ul id="primary-main-menu" class=%2$s>%3$s</ul>', 'fallback_cb' => false)); ?>
				<?php } ?>	
				<div class="clear"></div>
			</div>
			
			<?php if (!ot_get_option('header_search')) { 
				echo '<div id="header-search-wrapper" >'; 
					get_search_form();
				echo '</div>';
			} ?>
			
		</div>
	</div>

<!-- Title area -->
	<?php echo '<div id="title-wrapper"><div class="header-shadow"></div>
		<div class="page-title size-wrap"><h1>';
			if ( is_front_page() ) { 
				bloginfo('name');
			} elseif ( is_search() ) { 
				printf( __( 'Search Results for %s', 'kickstart' ), '<span>' . get_search_query() . '</span>' );
			} elseif ( class_exists( 'Woocommerce' ) && is_woocommerce() ) {
				woocommerce_page_title();
			} elseif ( is_category() || is_tax() ){ 
				single_cat_title();
			} elseif ( is_tag() ){ 
				single_tag_title(__('Posts Tagged: ', 'kickstart'));
			} elseif ( is_archive() ){
				if ( is_day() ) {
					printf( __( 'Archive for <span>%s</span>', 'kickstart' ), get_the_date());
				} elseif ( is_month() ) {
					printf( __( 'Archive for <span>%s</span>', 'kickstart' ), get_the_date( 'F, Y' ));
				} elseif ( is_year() ) {
					printf( __( 'Archive for <span>%s</span>', 'kickstart' ), get_the_date( 'Y' ));
				} elseif ( is_author() ) {
					printf( __( 'Archives by: <span>%s</span>', 'kickstart' ), get_the_author_meta( 'display_name', $wp_query->post->post_author ));
				} elseif ( is_post_type_archive() ) {
					post_type_archive_title();
				} else {
					_e( 'Archives', 'kickstart' );
				}
			} elseif( is_404() ) {
				_e('Error 404', 'kickstart');
			} else { 
				the_title(); 
			} 	
	echo '</h1>';
	if (!ot_get_option('disable_breadcrumbs')){ mnky_breadcrumb(); }
	echo '<div class="clear"></div></div></div>'; ?>

<!-- Content wrapper -->
	<div id="wrapper" class="size-wrap">