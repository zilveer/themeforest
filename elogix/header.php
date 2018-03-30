<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
	
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	
	<?php if (is_search()) { ?>
	   <meta name="robots" content="noindex, nofollow" /> 
	<?php } ?>

	<title>
		   <?php
  			global $page, $paged;
  			wp_title('|', true, 'right');
  			bloginfo('name');
  			$site_description = get_bloginfo('description', 'display');
  			if ($site_description && (is_home() || is_front_page())) { echo " | $site_description"; }
  			if ( $paged >= 2 || $page >= 2 ) { echo ' | ' . sprintf('Page %s', max($paged, $page)); }
  			?>
	</title>
	
	<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
	
	<?php if ( of_get_option('favicon_upload') != "" ) { ?>
		<link rel="shortcut icon" href="<?php echo of_get_option('favicon_upload'); ?>" />
	<?php } ?>
	
	
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/framework/css/responsive.css" type="text/css" />
	
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<?php wp_head(); ?>
    
</head>

<body <?php body_class(); ?>>
	
	<?php if ( wp_get_attachment_url(get_post_meta(get_the_ID(), 'minti_bgimage', true)) == '' ){ ?>
		
			
		
				<?php if (of_get_option('bgrepeat_select') == 'stretch' ) { /* ------------------------- IF BG-REPEAT = STRETCH */ ?>
						
						<img id="background" src="<?php echo of_get_option('bgimage_upload'); ?>" alt="" />
							
			    <?php } else { /* ------------------------- IF BG-REPEAT != STRETCH */ ?>
			    
			    		<div id="background" style="background-image:url(<?php echo of_get_option('bgimage_upload'); ?>); background-position: <?php echo of_get_option('bgposition_select'); ?>; background-repeat: <?php echo of_get_option('bgrepeat_select'); ?>;"></div>
			    
			    <?php } ?>  
		
	<?php } else { ?>

				<?php if (get_post_meta( get_the_ID(), 'minti_bgrepeat', true ) == 'stretch' ) { /* ------------------------- IF BG-REPEAT = STRETCH */ ?>
						
							<img id="background" src="<?php echo wp_get_attachment_url( get_post_meta( get_the_ID(), 'minti_bgimage', true ) ); ?>" alt="" />
							
			    <?php } else { /* ------------------------- IF BG-REPEAT != STRETCH */ ?>
			    
			    		<div id="background" style="background-image:url(<?php echo wp_get_attachment_url( get_post_meta( get_the_ID(), 'minti_bgimage', true ) ); ?>); background-position: <?php echo get_post_meta( get_the_ID(), 'minti_bgposition', true ); ?>; background-repeat: <?php echo get_post_meta( get_the_ID(), 'minti_bgrepeat', true ); ?>;"></div>
			    
			    <?php } ?>  
    
     <?php } ?> 
	
	<div id="wrap">
		
		<?php if ( of_get_option('infobar_checkbox') == true ) { ?>
			<div id="infobar"<?php if ( of_get_option('infobar_visible') == true ) { echo ' class="showit"'; } ?>>
				<?php echo of_get_option('infobar_text'); ?>
				<div class="openbtn cursor">Open</div>
				<div class="closebtn">X</div>
			</div>
		<?php } else { ?>
			<div id="infobar2"></div>
		<?php } ?>

		<div id="header" class="clearfix">

			<div id="logo"><a href="<?php echo home_url(); ?>/">
				<?php if ( of_get_option('logo_upload') ) { ?>
            		<img src="<?php echo of_get_option('logo_upload'); ?>" alt="<?php bloginfo('name'); ?>" />
            	<?php } else { ?>
            		<?php bloginfo('name'); ?>
            	<?php } ?>
			</a></div>
			
			<div id="slogan"><?php bloginfo('description'); ?>
			</div>
			
			<div id="social" class="clearfix">
				<ul>
					<?php if ( of_get_option('twitter_url') ) { ?>
						<li class="twitter"><a href="http://twitter.com/<?php echo of_get_option('twitter_url'); ?>" target="_blank" title="Twitter">
							<?php _e('Twitter', 'framework'); ?>	
						</a></li>
					<?php } ?>
					<?php if ( of_get_option('facebook_url') ) { ?>
						<li class="facebook"><a href="<?php echo of_get_option('facebook_url'); ?>" target="_blank" title="Facebook">
							<?php _e('Facebook', 'framework'); ?>
						</a></li>
					<?php } ?>
					<?php if ( of_get_option('dribbble_url') ) { ?>
						<li class="dribbble"><a href="<?php echo of_get_option('dribbble_url'); ?>" target="_blank" title="Dribbble">
							<?php _e('Dribbble', 'framework'); ?>
						</a></li>
					<?php } ?>
					<?php if ( of_get_option('flickr_url') ) { ?>
						<li class="flickr"><a href="<?php echo of_get_option('flickr_url'); ?>" target="_blank" title="Flickr">
							<?php _e('Flickr', 'framework'); ?>
						</a></li>
					<?php } ?>
					<?php if ( of_get_option('google_url') ) { ?>
						<li class="google"><a href="<?php echo of_get_option('google_url'); ?>" target="_blank" title="Google">
							<?php _e('Google+', 'framework'); ?>
						</a></li>
					<?php } ?>
					<?php if ( of_get_option('youtube_url') ) { ?>
						<li class="youtube"><a href="<?php echo of_get_option('youtube_url'); ?>" target="_blank" title="YouTube">
							<?php _e('YouTube', 'framework'); ?>
						</a></li>
					<?php } ?>
					<?php if ( of_get_option('vimeo_url') ) { ?>
						<li class="vimeo"><a href="<?php echo of_get_option('vimeo_url'); ?>" target="_blank" title="Vimeo">
							<?php _e('Vimeo', 'framework'); ?>
						</a></li>
					<?php } ?>
					<?php if ( of_get_option('linkedin_url') ) { ?>
						<li class="linkedin"><a href="<?php echo of_get_option('linkedin_url'); ?>" target="_blank" title="LinkedIn">
							<?php _e('LinkedIn', 'framework'); ?>
						</a></li>
					<?php } ?>
					<?php if ( of_get_option('pinterest_url') ) { ?>
						<li class="pinterest"><a href="<?php echo of_get_option('pinterest_url'); ?>" target="_blank" title="Pinterest">
							<?php _e('Pinterest', 'framework'); ?>
						</a></li>
					<?php } ?>
				</ul>
			</div>
			
		</div>
		
		<div id="nav" class="clearfix">
			<?php wp_nav_menu(array('theme_location' => 'main', 'menu_class' => 'nav')); ?>
			<div class="clear"></div>
		</div>

