<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js" >
<!-- start -->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="format-detection" content="telephone=no">

	<!-- set faviocn-->
	<?php 
	global $pmc_data; 
	$favicon = ''; 
	if(isset($pmc_data['favicon']))
		$favicon = $pmc_data['favicon'];
	if (empty($favicon)) { $favicon = get_template_directory_uri() .'/images/favicon.ico'; }	
	?>
		
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<link rel="icon" type="image/png" href="<?php echo $pmc_data['favicon'] ?>">
	<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />

	<?php if ( is_singular() && get_option( 'thread_comments' ) ) {wp_enqueue_script( 'comment-reply' ); }?>
	
	<!-- add google analytics code -->
	<?php 		
	if(isset($pmc_data['google_analytics'])) 
	echo pmc_stripText($pmc_data['google_analytics']); 
	?>
	<?php wp_head();?>
</head>		
<!-- start body -->
<body <?php body_class(); ?>>
	<!-- start header -->
	<header>
		<div id="headerwrap" >
			<!-- fixed menu -->
			<div class="pagenav fixedmenu">
				<div class="holder-fixedmenu">
					<div class="logo-fixedmenu">
						<?php $logo = $pmc_data['logo']; ?>
						<a href="<?php echo home_url(); ?>"><img src="<?php if ($logo != '') {?><?php echo $logo; ?><?php } else {?><?php get_template_directory_uri(); ?>/images/logo.png<?php }?>" alt="<?php bloginfo('name'); ?> - <?php bloginfo('description') ?>" ></a>
					</div>
					<div class="menu-fixedmenu">
						<?php 
						if ( has_nav_menu( 'scroll_menu' ) ) {
							 wp_nav_menu( array(
							 'container' =>false,
							 'container_class' => 'menu-scroll',
							 'theme_location' => 'scroll_menu',
							 'echo' => true,
							 'fallback_cb' => 'ideo_fallback_menu',
							 'before' => '',
							 'after' => '',
							 'link_before' => '',
							 'link_after' => '',
							 'depth' => 0,
							 'walker' => new description_walker())
							 ); 
						}
						?>
					</div>
				</div>
			</div>	
			<!-- top bar -->
			<div class="TopHolder">
				<?php pmc_showTop()	?>	
			</div>	
			<!-- logo and main menu -->
			<div id="header">	
				<div class = "header-inner">
					<div id="logo">
						<?php $logo = $pmc_data['logo']; ?>
						<a href="<?php echo home_url(); ?>"><img src="<?php if ($logo != '') {?><?php echo $logo; ?><?php } else {?><?php get_template_directory_uri(); ?>/images/logo.png<?php }?>" alt="<?php bloginfo('name'); ?> - <?php bloginfo('description') ?>" /></a>
					</div>
					<!-- respoonsive menu main-->
					<div class="respMenu noscroll">
						<div class="resp_menu_button"><i class="fa fa-list-ul fa-2x"></i></div>
						<?php 
						if ( has_nav_menu( 'resp_menu' ) ) {
							$menuParameters =  array(
							  'theme_location' => 'resp_menu', 
							  'walker'         => new Walker_Responsive_Menu(),
							  'echo'            => false,
							  'container_class' => 'menu-main-menu-container',
							  'items_wrap'     => '<div class="event-type-selector-dropdown">%3$s</div>',
							);
							echo strip_tags(wp_nav_menu( $menuParameters ), '<a>,<br>,<div>,<i>,<strong>' );
						}
						?>	
					</div>	
					<!-- main menu -->
					<div class="pagenav">
						<?php 
						if ( has_nav_menu( 'main-menu' ) ) {
							 wp_nav_menu( array(
							 'container' =>false,
							 'container_class' => 'menu-header',
							 'theme_location' => 'main-menu',
							 'echo' => true,
							 'fallback_cb' => 'ideo_fallback_menu',
							 'before' => '',
							 'after' => '',
							 'link_before' => '',
							 'link_after' => '',
							 'depth' => 0,
							 'walker' => new description_walker())
							 ); 
						}
						?>

					</div>	
					<!-- header shop block -->
					<div class = "header-shop">
						<?php
						if (function_exists( 'is_woocommerce' ) ) { 
							pmc_cartShow();
						}	
						?>
					</div>
				</div>
			</div>	
		</div>			
	</header>			