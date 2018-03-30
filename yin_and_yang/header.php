<!DOCTYPE html>
<!--[if(IE 9)&!(IEMobile)]> <html <?php language_attributes(); ?> class="no-js ie9 oldie"> <![endif]-->
<!--[if (lt IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>"/>
		
	<!-- meta tags -->	
	<meta name="description" content="<?php bloginfo( 'description' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
			
  	<!-- RSS and pingback -->
  	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> Feed" href="<?php echo home_url(); ?>/feed/">
  	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		
	<!-- wordpress head functions -->
	<?php wp_head(); ?>
	<!-- end of wordpress head -->	
</head>

<body id="bg-hook" <?php body_class(); ?>>
	
<?php 
	// Logo 	
	$logo_url = get_theme_mod('oy_logo', ''); 
	$is_logo_retina = get_theme_mod('oy_is_logo_retina', ''); 
	
	// Menu 
	$locations = get_nav_menu_locations(); 
	$is_menu_existent = (count($locations) && isset($locations['main'])) ? $locations['main'] : false;
	
	// Drop-down page at the top of the window 
	$dropdown_page = get_theme_mod('oy_drop_down_page'); 
	
	// Tagline 
	$tagline = get_theme_mod('oy_tagline', ''); 
?>		

	<?php if($dropdown_page) { ?>
			
		<div id="dropdown-wrapper" class="tabbed-content">
			<div>
		 		<div class="dropdown-page group">
		 			<?php
						$page_data = get_page($dropdown_page);
						$content = apply_filters('the_content', $page_data->post_content); // Get Content and retain Wordpress filters such as paragraph tags.
					
						echo $content;
					?>
				</div>
				<!-- /.dropdown-page --> 
			</div>
		</div>
		<!-- /#dropdown-wrapper --> 
	
	<?php } ?>
	
	<div class="main-container group">
		
		<header class="header group">
			
			<div class="group">
				<?php if($is_menu_existent) { ?>
			
					<?php wp_nav_menu( array( 'theme_location' => 'main', 'container' => 'nav', 'menu' => 'custom_menu', 'container_class' => 'menu-container group', 'menu_class' => 'menu', 'depth' => 2, 'walker' => new Onioneye_Menu_Walker() ) ); ?>
					
				<?php } ?>
				
				<?php if($dropdown_page) { ?>
				
					<div id="dropdown-trigger"><?php $page = get_post($dropdown_page); echo $page->post_title; ?><span class="drop-down-arrows">&nbsp;</span></div>
				
				<?php } ?>
			</div><!-- /.group -->
			
			<div class="branding group <?php if(!$is_menu_existent && !$dropdown_page) { echo esc_attr('no-top-nav'); } ?>">
				<div class="logo-container">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
						
						<?php if($logo_url && $is_logo_retina) { ?>
						
							<?php $image_details = onioneye_get_retina_image_data($logo_url); ?>
							
							<img src="<?php echo esc_url($image_details[0]); ?>" 
							alt="<?php esc_attr_e( 'Site Logo', 'onioneye' ); ?>" width="<?php echo esc_attr($image_details[1]); ?>" height="<?php echo esc_attr($image_details[2]); ?>">
						
						<?php } else if($logo_url && !$is_logo_retina) { ?>				
							
							<img src="<?php echo esc_url($logo_url); ?>" alt="<?php esc_attr_e( 'Site Logo', 'onioneye' ); ?>">
						
						<?php } else { ?>		
							
							<span class="textual-logo"><?php bloginfo('name'); ?></span>
						
						<?php } ?>
									
					</a>
				</div><!-- /.logo-container -->
				
				<?php if($is_menu_existent) { ?>
				
					<ul class="mobile-menu">
						<li>
							<a class="menu-button" href="#">Open menu</a>
							
							<?php wp_nav_menu( array( 'theme_location' => 'main', 'container' => false, 'menu' => 'custom_menu', 'menu_class' => 'menu', 'depth' => 2, 'walker' => new Onioneye_Menu_Walker() ) ); ?>
						</li>
					</ul><!-- /.mobile-menu -->
				
				<?php } ?>
				
				<?php if($tagline) { ?>
					
					<div class="tagline-container group">
				    	<p class="tagline"><?php echo $tagline; ?></p>
				    </div>
				    
				<?php } ?>
			</div><!-- /.branding -->
			
		</header><!-- /.header -->

		<div class="main-content group">