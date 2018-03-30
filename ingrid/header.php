<?php	
// get the id of this page
	$GLOBALS['get_the_id'] = get_the_ID();
	$GLOBALS['tp_check_origin'] = '1';
?>
<!DOCTYPE html>
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<?php
	$tp_responsive = get_option('tp_responsive');
	if($tp_responsive == 'off'){
	print '<meta name="viewport" content="width=1024" />';
	}else{
	print '<meta name="viewport" content="width=device-width, initial-scale=1" />';
	}
	?>

	<title><?php	
	$title = wp_title( '|', false, 'right' ); 
	print $title;
	bloginfo('name');
	?></title>

	<?php
	$tp_favicon = get_option('tp_favicon');
	if(!empty($tp_favicon)){print '<link rel="shortcut icon" href="'.$tp_favicon.'" />
';} 
	?>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<!--[if lt IE 9]>
	<script src="<?php print get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
	<![endif]-->
	
		
	<script type="text/javascript">	
	var template_url = '<?php print get_template_directory_uri(); ?>';
	var tp_responsive = '<?php print get_option('tp_responsive'); ?>';
	</script>
	
	<?php $tp_tracking_code = get_option('tp_tracking_code');
	print stripslashes($tp_tracking_code); 	
	
	wp_head(); 
	
	?>	
</head>

<body <?php body_class(); ?>>


	<!-- DISPLAY MESSAGE IF JAVA IS TURNED OFF -->
	<noscript>		
		<div id="notification"><?php print __('PLEASE TURN ON JAVASCRIPT IN YOUR BROWSER FOR THE MAXIMUM EXPERIENCE!','ingrid');?></div>
	</noscript>

	
	<!-- DISPLAY THIS MESSAGE IF USER'S BROWSER IS IE7 OR LOWER -->
	<div id="ie_warning"><img src="<?php print get_template_directory_uri(); ?>/images/warning.png" alt="IE Warning" /><br /><strong><?php print __('YOUR BROWSER IS OUT OF DATE!','ingrid');?></strong><br /><br /><?php print __('This website uses the latest web technologies so it requires an up-to-date, fast browser!<br />Please try <a href="http://www.mozilla.org/en-US/firefox/new/?from=getfirefox">Firefox</a> or <a href="https://www.google.com/chrome">Chrome</a>!','ingrid');?></div>
	
	<div id="toTop"><i class="fa fa-angle-up"></i></div>
			
			


	<header id="main">
		<div id="top_panel"<?php
			$tp_panel_texture = get_option('tp_panel_texture');				
			if(!empty($tp_panel_texture)){
				print ' class="'.$tp_panel_texture.'"';
			}
			
		?>>&nbsp;</div>
		<div id="top_panel_line">&nbsp;</div>
		<div id="top_panel_stars">&nbsp;</div>
		
			<!-- MENU -->						
		<nav>
			<?php
				if( function_exists( 'has_nav_menu' ) && has_nav_menu( 'primary' ) ) {			
					wp_nav_menu( array( 
						'container' => 'false',
						'theme_location' => 'primary',
						'menu_class' => 'menu',
						'echo' => true,
						'before' => '',
						'after' => '',
						'link_before' => '',
						'link_after' => '',
						'depth' => 0,
						'walker' => new description_walker())
					); 
				}			
			?>
			
			<!-- RESPONSIVE MENU -->
			<?php

			function gm_get_theme_menu_name( $theme_location ) {
				if( ! $theme_location ) return false;
			 
				$theme_locations = get_nav_menu_locations();
				if( ! isset( $theme_locations[$theme_location] ) ) return false;
			 
				$menu_obj = get_term( $theme_locations[$theme_location], 'nav_menu' );
				if( ! $menu_obj ) $menu_obj = false;
				if( ! isset( $menu_obj->name ) ) return false;
			 
				return $menu_obj->name;
			}
			

			if( function_exists( 'has_nav_menu' ) && has_nav_menu( 'primary' ) ) {			
				$menu_items = wp_get_nav_menu_items( gm_get_theme_menu_name('primary') );
				if(!empty($menu_items)){
					print '<select id="responsive-menu">
						<option value="">'.__('- Please Select a Page -','ingrid').'</option>';
					foreach($menu_items as $menu_i){
						print '<option value="'.$menu_i->url.'">';
						if($menu_i->menu_item_parent != '0'){
							print '&nbsp;- ';
						}
						print $menu_i->title.'</option>
						';
					}
					print '</select>
					';
				}
			}
			//print_r($menu_items);
			
			?>
			
			
			<div class="menu_bottom"></div>
			
			
			
			<!-- LOGO -->
			<div id="logo"><a href="<?php print home_url(); ?>">
			<?php
			if(get_option('tp_logo') != ''){												
				print '<img src="'.get_option('tp_logo').'" alt="logo" />';				
			}else{
				print '<img src="'. get_template_directory_uri() .'/images/logo.png" alt="logo" />';
			}
			?></a>
			</div>
						
			
			
		</nav>
	</header>

	
	