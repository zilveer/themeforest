<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

    <meta charset="<?php bloginfo( 'charset' ); ?>" />   
    <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">    
    
    <?php
    
    global $smof_data; 
    
    if(array_key_exists('vntd_custom_favicon', $smof_data)) {
	    if($smof_data['vntd_custom_favicon'] ) {
	    	echo '<link rel="shortcut icon" href="'.$smof_data['vntd_custom_favicon'].'" />';
	    }   
	}
	wp_head(); 
	
	?>        

</head>

<body <?php body_class( vntd_body_skin() ); ?>>
	
	<section id="home"></section>
	
	<?php
	
	
	if(array_key_exists('vntd_loader', $smof_data)) { if($smof_data['vntd_loader'] || !isset($smof_data['vntd_loader'])) { 
	
		$loader_class = 'dark-border';
		$vntd_skin = '';
		if(array_key_exists('vntd_skin', $smof_data)) {
			$vntd_skin = $smof_data['vntd_skin'];
		}
		if($vntd_skin == 'dark') {
			$loader_class = 'colored-border';
		}
	
		?>
		<!-- Page Loader -->
		<section id="pageloader" class="white-bg">
			<div class="outter <?php echo $loader_class; ?>">
				<div class="mid <?php echo $loader_class; ?>"></div>
			</div>
		</section>
		<?php 
		
	}}
	
	if(vntd_navbar_style('style') != 'disable') {
	
	?>
	
	
	
	<nav id="navigation<?php echo vntd_navbar_style('id'); ?>" class="<?php echo vntd_navbar_style(); ?>">
	
		<div class="nav-inner">
			<div class="logo">
				<!-- Navigation Logo Link -->
				<a href="<?php vntd_logo_url(); ?>" class="scroll">
					<?php
					$navbar_color = '';
					if(array_key_exists('vntd_navbar_color', $smof_data)) {
						$navbar_color = $smof_data['vntd_navbar_color'];
					}
					if(array_key_exists('vntd_logo_url', $smof_data)) {
						if(vntd_navbar_style('style') == 'style2' && $smof_data['vntd_logo_light_url'] && get_post_meta(vntd_get_id(),'navbar_color',TRUE) != 'white' || $navbar_color == 'dark' && $smof_data['vntd_logo_light_url']) {
							$logo_url = $smof_data['vntd_logo_light_url'];
						} else {
							$logo_url = $smof_data['vntd_logo_url'];
						}
					
						echo '<img class="site_logo" src="'.$logo_url.'" alt="'.get_bloginfo().'">';
					}
					?>
				</a>
			</div>
			<!-- Mobile Menu Button -->
			<a class="mobile-nav-button colored"><i class="fa fa-bars"></i></a>
			<!-- Navigation Menu -->
			<div class="nav-menu nav-menu-desktop clearfix semibold">
				 
				<?php 			
				
				if (has_nav_menu('primary')) {
					wp_nav_menu( array('theme_location' => 'primary','container' => false,'menu_class' => 'nav uppercase font-primary','walker' => new Vntd_Custom_Menu_Class())); 
				} else {
					echo '<span class="vntd-no-nav">No custom menu created!</span>';
				}	
				
				if(class_exists('Woocommerce') && $smof_data['vntd_topbar_woocommerce']) vntd_woo_nav_cart();			
				
				?>	

			</div>
			<div class="nav-menu nav-menu-mobile clearfix semibold">
							 
				<?php 			
				
				if (has_nav_menu('primary')) {
					wp_nav_menu( array('theme_location' => 'primary','container' => false,'menu_class' => 'nav uppercase font-primary','walker' => new Vntd_Custom_Menu_Class())); 
				} else {
					echo '<span class="vntd-no-nav">No custom menu created!</span>';
				}	
				
				if(class_exists('Woocommerce') && $smof_data['vntd_topbar_woocommerce']) vntd_woo_nav_cart();			
				
				?>	

			</div>
		</div>
	</nav>
	
	<?php 
	
	}
	
	if(!is_front_page() && $smof_data['vntd_header_title'] != 0 && get_post_meta(vntd_get_id(), 'page_header', true) != 'no-header' && !is_404() && !is_page_template('template-onepager.php')) {
		vntd_print_page_title();
	}
	
	?>
	
	<div id="page-content">