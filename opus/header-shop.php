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
	
	<!-- set title of the page -->
	<title>
	<?php
	global $page, $paged;
	wp_title( '|', true, 'right' );
	bloginfo( 'name' );
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( 'Page %s' , max( $paged, $page ) );
	?>
	</title>

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
<body <?php body_class('raindrop'); ?> >

	<!-- start header -->
			<!-- fixed menu -->		
			<?php 
			global $pmc_data;
			include_once( ABSPATH . 'wp-admin/includes/plugin.php' );			
			$scroll_menu = 'pmcscrollmenu';
			$scroll_menu_single = 'pmcsinglemenu';
			$scrollmenu = '';
			$scrollmenu = get_option( 'scroll_menu-'.get_the_id() );
			if($scrollmenu != ''){
				$scroll_menu = $scrollmenu;
				$scroll_menu_single = $scrollmenu;
			}	
			?>	
			
			<div class="pagenav fixedmenu">						
				<div class="holder-fixedmenu">							
					<div class="logo-fixedmenu">								
					<?php 
					if(isset($pmc_data['scroll_logo']) && @file_get_contents($pmc_data['scroll_logo'])){
						$logo = $pmc_data['scroll_logo']; 
					} else {
						$logo = $pmc_data['logo']; 
					} ?>							
					<a href="<?php echo home_url(); ?>"><img src="<?php if ($logo != '') {?><?php echo $logo; ?><?php } else {?><?php get_template_directory_uri(); ?>/images/logo.png<?php }?>" alt="<?php bloginfo('name'); ?> - <?php bloginfo('description') ?>" ></a>
					</div>
						<?php
						
						if(is_front_page()){ ?>
						<div class="menu-fixedmenu home">
						<?php
						if ( has_nav_menu( $scroll_menu ) ) {
						wp_nav_menu( array(
						'container' =>false,
						'container_class' => 'menu-scroll',
						'theme_location' => $scroll_menu,
						'echo' => true,
						'fallback_cb' => 'ecorecycle_fallback_menu',
						'before' => '',
						'after' => '',
						'link_before' => '',
						'link_after' => '',
						'depth' => 0,
						'walker' => new pmc_Walker_Main_Menu())
						);
						}
						}
						else { ?>
						<div class="menu-fixedmenu">
						<?php
						if ( has_nav_menu( $scroll_menu_single ) ) {
						wp_nav_menu( array(
						'container' =>false,
						'container_class' => 'menu-scroll',	
						'theme_location' => $scroll_menu_single,
						'echo' => true,
						'fallback_cb' => 'ecorecycle_fallback_menu',
						'before' => '',
						'after' => '',
						'link_before' => '',
						'link_after' => '',
						'depth' => 0,
						'walker' => new pmc_Walker_Main_Menu())
						); 
						}	
						}	
						?>	
					</div>
				</div>	
			</div>
			<?php 
			if(!is_plugin_active( 'page-builder-pmc/page-builder-pmc.php')) { 
				$main_menu= 'pmcmainmenu';		
				$resp_menu = 'pmcrespmenu';
				$resp_single_menu = 'pmcrespsinglemenu';	
				?>
				<header>
					<div id="headerwrap">			
						<!-- logo and main menu -->
						<div id="header">
							<div id="logo">
								<?php $logo = $pmc_data['logo']; ?>
								<a href="<?php echo home_url(); ?>"><img src="<?php if ($logo != '') {?>
								<?php echo $logo; ?><?php } else {?><?php get_template_directory_uri(); ?>/images/logo.png<?php }?>" alt="<?php bloginfo('name'); ?> - <?php bloginfo('description') ?>" /></a>
							</div>
							<!-- respoonsive menu main-->
							<!-- respoonsive menu no scrool bar -->
							<div class="respMenu noscroll">
								<div class="resp_menu_button"><i class="fa fa-list-ul fa-2x"></i></div>
								<?php 
								if(is_front_page()){
									if ( has_nav_menu( $resp_menu ) ) {
										$menuParameters =  array(
										  'theme_location' => $resp_menu, 
										  'walker'         => new pmc_Walker_Responsive_Menu(),
										  'echo'            => false,
										  'items_wrap'     => '<div class="event-type-selector-dropdown">%3$s</div>',
										);
										echo strip_tags(wp_nav_menu( $menuParameters ), '<a>,<br>,<div>,<i>,<strong>' );
									}
								}else{
									if ( has_nav_menu( $resp_single_menu ) ) {
										$menuParameters =  array(
										  'theme_location' => $resp_single_menu, 
										  'walker'         => new pmc_Walker_Responsive_Menu(),
										  'echo'            => false,
										  'items_wrap'     => '<div class="event-type-selector-dropdown">%3$s</div>',
										);
										echo strip_tags(wp_nav_menu( $menuParameters ), '<a>,<br>,<div>,<i>,<strong>' );
									}						
								}
								
								?>	
							</div>			
							<!-- main menu -->
								<?php 
								if(is_front_page()){?>
								<div class="pagenav home mainmenu menu-right"> 
								<?php
									if ( has_nav_menu( $main_menu ) ) {
										 wp_nav_menu( array(
										 'container' =>false,
										 'container_class' => 'menu-header home',
										 'theme_location' => $main_menu,
										 'echo' => true,
										 'fallback_cb' => 'ecorecycle_fallback_menu',
										 'before' => '',
										 'after' => '',
										 'link_before' => '',
										 'link_after' => '',
										 'depth' => 0,
										 'walker' => new pmc_Walker_Main_Menu())
										 ); 
									} ?>

								</div> <?php
								}
								else {

									if ( has_nav_menu( $scroll_menu_single ) ) {?>
									<div class="pagenav mainmenu menu-right"> 
									<?php						
										 wp_nav_menu( array(
										 'container' =>false,
										 'container_class' => 'menu-header',
										 'theme_location' => $scroll_menu_single,
										 'echo' => true,
										 'fallback_cb' => 'ecorecycle_fallback_menu',
										 'before' => '',
										 'after' => '',
										 'link_before' => '',
										 'link_after' => '',
										 'depth' => 0,
										 'walker' => new pmc_Walker_Main_Menu())
										 ); 
								} ?>

								</div> <?php					
								}
								?>			
						</div>
					</div>			
				</header>	
				<?php
			} else {
				global $pmc_data;
				
				if((!isset($pmc_data['woocommerce_header']) || $pmc_data['woocommerce_header'] == 'none') ){
					echo do_shortcode( '[template id="'.$pmc_data['top_content'].'"]');
				}
				else if(isset($pmc_data['woocommerce_header']) && $pmc_data['woocommerce_header'] != 'none'){
					echo do_shortcode( stripslashes('[template id="'.$pmc_data['woocommerce_header'].'"]') );
				}				
				else{
				}
			}
			?>